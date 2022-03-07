<?php

it('has login route', function () {
    $response = $this->post('/api/auth/login');

    //Testando a rota
    //Teste precisa dar Unauthenticate, pois não é passada nenhum parametro.
    $response->assertStatus(401);

});
