<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    /**
     * @test
     */
    function prueba_de_carga_de_usuarios()
    {
        //$this->assertTrue(true);
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Hola usuario');
    }
    /**
     * @test
     */
    function prueba_de_carga_detalle_usuario(){
        $this->get('/usuarios/90')
        ->assertStatus(200)
        ->assertSee("Mostrando detalle del usuario: 90");
    }
    /**
     * @test
     */
    function create_new_user(){
        $this->withoutExceptionHandling();
        $this->get('/usuarios/nuevo')
        ->assertStatus(200)
        ->assertSee("Nuevo usuario");
    }
    /**
     * @test
     */
    function it_edit_user(){
        $this->get('/usuarios/29/edit')
        ->assertStatus(200)
        ->assertSee("Editar usuario: 29");
    }

}
