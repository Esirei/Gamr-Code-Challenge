<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function testUserRegistration()
    {
        $data = User::factory()->raw();

        $this->postJson(route('api.register'), $user = array_merge($data, ['password_confirmation' => $data['password']]))
            ->assertCreated()
            ->assertJsonPath('data.email', $user['email'])
            ->assertJsonStructure(['data' => ['id', 'email'], 'token']);
    }

    public function testUserRegistrationPasswordConfirmationError()
    {
        $this->postJson(route('api.register'), User::factory()->raw())
            ->assertJsonValidationErrorFor('password')
            ->assertJsonMissingValidationErrors(['email', 'name']);
    }

    public function testUserRegistrationError()
    {
        $this->postJson(route('api.register'))
            ->assertJsonValidationErrors(['email', 'password', 'name']);
    }
}
