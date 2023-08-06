<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexUsersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_index_users(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/register', [
            'name' => $user->name,
            'email' => 'example@email.com',
            'password' => $user->password,
        ]);

        $user = User::factory()->create();

        $response = $this->post('/api/register', [
            'name' => $user->name,
            'email' => 'example2@email.com',
            'password' => $user->password,
        ]);

        $user = User::factory()->create();

        $response = $this->post('/api/register', [
            'name' => $user->name,
            'email' => 'example3@email.com',
            'password' => $user->password,
        ]);

        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }
}
