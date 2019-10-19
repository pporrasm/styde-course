<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    //Hace un migrate:refresh al ejecutar las pruebas, en la DB definida en la variabla DB_DATABASE del phpunit.xml
    use RefreshDatabase;
    /**
     * @test
     */
    function prueba_de_carga_de_usuarios()
    {
        //$this->assertTrue(true);
        factory(User::class)->create(['name' => 'Joel', 'website' => 'myblogsite.top']);

        factory(User::class)->create([
                'name' => 'Elie',
        ]);

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Joel')
            ->assertSee('Elie');
    }
    /**
     * @test
     */
    function usuario_no_registrados(){
        //DB::table('users')->truncate();
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('No existen usaurios registrados.');
    }
    
    /**
     * @test
     */
    function prueba_de_carga_detalle_usuario(){
        $user = factory(User::class)->create(['name' => 'Pedro Porras']);
        $this->get('/usuarios/'.$user->id)
        ->assertStatus(200)
        ->assertSee("Pedro Porras");
    }
    /**
     * @test
     */
    function create_new_user(){
        $this->withoutExceptionHandling();
        $this->get('/usuarios/nuevo')
        ->assertStatus(200)
        ->assertSee("Crear nuevo usuario");
    }
    /**
     * @test
     */
    function it_edit_user(){
        $this->get('/usuarios/29/edit')
        ->assertStatus(200)
        ->assertSee("Editar usuario");
    }

}
