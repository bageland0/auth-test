<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OnlineUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_is_online(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/register', [
            'name' => $user->name,
            'email' => 'example@email.com',
            'password' => $user->password,
        ]);

        $response->assertStatus(201);

        $response = $this->post('/api/login', [
            'email' => 'example@email.com',
            'password' => $user->password,
        ]);

        $response->assertStatus(200);

        $response = $this->get('/api/users/'.$user->id.'/is_online');

        $this->assertTrue($response['result']);
    }
}
