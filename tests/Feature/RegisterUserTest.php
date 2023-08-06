<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_register(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/register', [
            'name' => $user->name,
            'email' => 'example@email.com',
            'password' => $user->password,
        ]);

        $response->assertStatus(201);
    }
}
