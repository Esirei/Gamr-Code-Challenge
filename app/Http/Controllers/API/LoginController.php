<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $user = $request->authenticate();

        $token = $user->createToken(config('app.name'))->plainTextToken;

        return response()->json([
            'data' => compact('token', 'user'),
        ]);
    }
}
