<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        $token = app('auth')->attempt($request->only('username', 'password'), true);

        // get user and update last login date
        $user = $request->user();
        $user->last_login_at = (string)Carbon::now();
        $user->save();

        return $this->respondWithToken($token, compact('user'));
    }

    /**
     * @param Request $request
     * @param $provider
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticateWithProvider(Request $request, $provider)
    {
        try {
            $provider_user = Socialite::driver($provider)->userFromToken($request->input('token'));

            $user = User::updateOrCreate([
                'provider' => 'Facebook',
                'provider_id' => $provider_user->id,
            ], [
                'name' => $provider_user->name,
                'email' => $provider_user->email,
                'avatar' => $provider_user->avatar_original,
                'access_token' => $provider_user->token,
                'last_login_at' => (string)Carbon::now(),
            ]);

            $token = app('auth')->login($user, true);

            return $this->respondWithToken($token, compact('user'));
        } catch (ClientException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token inválido.',
            ], $e->getResponse()->getStatusCode());
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro catastrófico.',
            ], 500);
        }
    }

    /**
     * Update user data
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'theme' => 'required|in:YELLOW,GREEN,PINK,RED,BLUE',
        ]);

        $user = $request->user();

        if($request->input('password')) {
            $user->password = app('hash')->make($request->input('password'));
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->theme = $request->input('theme');
        $user->save();

        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }

    public function avatar(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|image|max:8192',
        ]);

        $file = $request->file('avatar');
        if ($file->isValid()) {
            $target = $file->move(storage_path('app/user-avatar'), str_random(48) . '_' . time() . '.' . $file->getClientOriginalExtension());
            $url = url('img/user-avatar/' . $target->getFilename());

            $user = $request->user();
            $user->avatar = $url;
            $user->save();

            return response()->json([
                'success' => true,
                'avatar' => $url,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Houve um problema com o envio do seu avatar, tente novamente.'
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(app('auth')->refresh());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        app('auth')->logout();

        return response()->json([
            'success' => true,
            'message' => 'Logout realizado com sucesso.'
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function me(Request $request)
    {
        return $request->user();
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     * @param  array $additional_parameters
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $additional_parameters = null)
    {
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => app('auth')->factory()->getTTL() * 60,
        ];

        if ($additional_parameters) {
            $data = array_merge($data, $additional_parameters);
        }

        return response()->json($data);
    }
}
