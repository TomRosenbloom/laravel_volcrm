<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Organisation as Organisation;

class OrganisationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateOrganisation()
    {
        $user = factory(Organisation::class)->create();
    }
}
