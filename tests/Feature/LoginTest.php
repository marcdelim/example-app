<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_success()
    {
        $response = $this->postJson('/login', [
            'email' => 'backend1@multisyscorp.com',
            'password' => "test123"
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'access_token' => $response['access_token'],
            ]);
    }

    public function test_login_failed()
    {
        $response = $this->postJson('/login', [
            'email' => 'backend1@multisyscorp.com',
            'password' => "test1234"
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => 'Invalid Credentials',
            ]);
    }

    
}
