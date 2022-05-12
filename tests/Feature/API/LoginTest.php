<?php

namespace Tests\Feature\API;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testUserCanLogin()
    {
        $this->postJson(route('api.login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.id', $this->user->id)
            ->assertJsonStructure(['token', 'data' => ['id']]);
    }

    public function testUserEnteredWrongCredentials()
    {
        $this->postJson(route('api.login'), [
            'email' => $this->user->email,
            'password' => 'wrong-password',
        ])
            ->assertJsonValidationErrorFor('email');
    }
}
