<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    //Teste da Primeira rota/Endpoint da API
    public function testRotaPrincipal()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
