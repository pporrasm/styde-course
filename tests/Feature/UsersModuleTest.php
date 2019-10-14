<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    /** @test Esto es una prueba*/
    function prueba_de_carga_de_usuarios()
    {
        //$this->assertTrue(true);
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Hola usuario');
    }

    function prueba_de_carga_detalle_usuario(){
        $this->get('/usuarios/90')
        ->assertStatus(200)
        ->assertSee("Mostrando detalle del usuario: 90");
    }

}
