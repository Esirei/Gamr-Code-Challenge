<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Actions\GenerateUserToken;
use App\Http\Resources\UserResource;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $user = $request->authenticate();
        $token = app(GenerateUserToken::class)->execute($user);

        return UserResource::make($user)->additional(compact('token'));
    }
}
