<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_delete_user(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/register', [
            'name' => $user->name,
            'email' => 'example4@email.com',
            'password' => $user->password,
        ]);

        $response->assertStatus(201);

        $response = $this->post('/api/login', [
            'email' => 'example4@email.com',
            'password' => $user->password,
        ]);

        $response->assertStatus(200);

        $response = $this->delete('/api/users/'.$user->id);

        $response->assertStatus(200);
    }
}
