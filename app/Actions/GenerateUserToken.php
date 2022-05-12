<?php

namespace App\Actions;

use App\Models\User;

class GenerateUserToken
{
    public function execute(User $user)
    {
        return $user->createToken(config('app.name'))->plainTextToken;
    }
}
