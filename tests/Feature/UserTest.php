<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testCanCreateUser()
    {
        $this->assertDatabaseCount(User::class, 1);
    }

    public function testUserIsAuthenticatable()
    {
        $this->assertInstanceOf(Authenticatable::class, $this->user);
    }

    public function testUserPasswordIsHashed()
    {
        $this->assertNotEquals('password', $this->user->password);
        $this->assertTrue(Hash::check('password', $this->user->password));
    }
}
