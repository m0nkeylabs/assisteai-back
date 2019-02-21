<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $token = app('auth')->attempt($request->only('username', 'password'), true);

        // get user and update last login date
        $user = $request->user();
        $user->last_login_at = (string)Carbon::now();
        $user->save();

        return response()->json(compact('token', 'user'));
    }

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

            return response()->json(compact('token', 'user'));
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

    public function callback(Request $request, $provider = 'facebook')
    {
        dd($provider);
    }

    public function me(Request $request)
    {
        return $request->user();
    }
}