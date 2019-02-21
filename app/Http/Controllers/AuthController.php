<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $token = app('auth')->attempt($request->only('username', 'password'));
//        dd(app('hash')->make('123456'));

        return response()->json(compact('token'));
    }

    public function me(Request $request)
    {
        return $request->user();
    }
}