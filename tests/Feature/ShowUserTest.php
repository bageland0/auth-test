<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_show_user(): void
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

        $response = $this->get('/api/users/'.$user->id);

        $response->assertStatus(200);
    }
}
