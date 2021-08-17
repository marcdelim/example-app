<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_success()
    {
        $response = $this->postJson('/register', [
            'email' => 'backend121212@multisyscorp.com',
            'password' => "test121212"
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => 'User successfully registered',
            ]);
    }

    public function test_register_failed()
    {
        $response = $this->postJson('/register', [
            'email' => 'backend121212@multisyscorp.com',
            'password' => "test121212"
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => 'Email already taken',
            ]);
    }
}
