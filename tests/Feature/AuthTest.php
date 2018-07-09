<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User as User;

class AuthTest extends TestCase
{

    // using this trait restores database to original state after test
    // ah no, what it actually did was to completely empty the user table
    // er, no the whole fucking database!
    //use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_logs_in()
    {

        $user = factory(User::class)->create();

        $this->get(route('login'))
            ->type($user->email, 'email')
            ->type('testpass123', 'password')
            ->press('Login')
            ->see('logged in')
            ->onPage('/');
    }
}
