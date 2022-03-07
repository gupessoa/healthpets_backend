<?php

it('has api page', function () {
    //Testando se a APi esta ligada e funcional
    $response = $this->get('/');
    //Precisa retornar codigo http 200
    $response->assertStatus(200);
});
