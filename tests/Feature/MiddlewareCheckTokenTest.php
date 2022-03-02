<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareCheckTokenTest extends TestCase
{

    /** @test */
    public function debes_mandar_el_header()
    {

        $response = $this->getJson(route('usuarios.get'));

        $response->assertStatus(401);
    }
}
