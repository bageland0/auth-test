<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_update_user(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/register', [
            'name' => $user->name,
            'email' => 'expml1@er.er',
            'password' => $user->password,
        ]);

        $response->assertStatus(201);

        $response = $this->post('/api/login', [
            'email' => 'expml1@er.er',
            'password' => $user->password,
        ]);

        $response->assertStatus(200);

        $response = $this->patch('/api/users/'.$user->id, [
            'name' => 'Другое имя',
            'email' => 'ex@email.com',
            'password' => 'Другой пароль',
        ]);

        $response->assertStatus(201);
    }
}
