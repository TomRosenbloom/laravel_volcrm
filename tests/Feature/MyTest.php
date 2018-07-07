<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * test that create opportunity route exists and returns no error
     *
     * questions:
     * how to deal with authentication barrier?
     *
     */
    public function testCreateOpportunity()
    {
        $response = $this->get('/opportunities/create');

        $response->assertStatus(200);
    }
}
