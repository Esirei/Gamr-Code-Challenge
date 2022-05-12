<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Actions\GenerateUserToken;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $user = $request->authenticate();
        $token = app(GenerateUserToken::class)->execute($user);

        return response()->json([
            'data' => compact('token', 'user'),
        ]);
    }
}
