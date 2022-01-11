<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
//    public function testRotaLoginFuncionando()
//    {
//        $response = $this->get('/api/login');
//        $response->assertStatus(200);
//    }

    //Verificando se após as configurações do JWT aind aé permitido uma requisião sem token
    public function testVerificandoAutorizacaoDeApi()
    {
        $response = $this->post('/api/auth/login');
        $response->assertStatus(401);
    }
}
