<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Actions\GenerateUserToken;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::default()],
        ]);

        $user = User::create($data);
        $token = app(GenerateUserToken::class)->execute($user);

        return response()->json(['data' => compact('token', 'user')], 201);
    }
}
