<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Contracts\Auth\Guard;
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
                'avatar' => $provider_user->avatar,
                'access_token' => $provider_user->token,
                'last_login_at' => (string)Carbon::now(),
            ]);

            $token = app('auth')->login($user, true);

            return $this->respondWithToken($token, $user);
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

        return response()->json(['message' => 'Logout realizado com sucesso.']);
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