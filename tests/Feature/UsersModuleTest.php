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
    function usuario_no_registrados()
    {
        //DB::table('users')->truncate();
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('No existen usaurios registrados.');
    }

    /**
     * @test
     */
    function prueba_de_carga_detalle_usuario()
    {
        $user = factory(User::class)->create(['name' => 'Pedro Porras']);
        $this->get('/usuarios/' . $user->id)
            ->assertStatus(200)
            ->assertSee("Pedro Porras");
    }

    /**
     * @test
     */
    function create_new_user()
    {
        $this->withoutExceptionHandling();
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee("Formulario de registro");
    }

    /**
     * @test
     */
    function it_edit_user()
    {
        $this->get('/usuarios/29/edit')
            ->assertStatus(200)
            ->assertSee("Editar usuario");
    }

    /**
     * @test
     */
    function user_not_found()
    {
        $this->get('/usuarios/999')
            ->assertStatus(404)
            ->assertSee('Usuario no encontrado');
    }

    /**
     * @test
     */
    function it_creates_a_new_user()
    {
        $this->withoutExceptionHandling();
        $this->post('/usuarios/', [
            'name' => 'Pablo',
            'email' => 'pmedina@zoho.com',
            'password' => '123455'
            //])->assertSee('Procesando información');
            //])->assertRedirect('usuarios');
        ])->assertRedirect(route('users.index'));


        /*$this->assertDatabaseHas('users', [
            'name' => 'Pablo',
            'email' => 'pmedina@zoho.com',

        ]);*/
        $this->assertCredentials([
            'name' => 'Pablo',
            'email' => 'pmedina@zoho.com',
            'password' => '123455'
        ]);
    }

    /**
     * @test
     */
    function nombre_requerido()
    {
        //$this->withoutExceptionHandling();
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
            'name' => '',
            'email' => 'pmedina@zoho.com',
            'password' => '123455'
        ])->assertRedirect('/usuarios/nuevo')
            ->assertSessionHasErrors(['name' => 'El campo es obligatorio']);

        // Debe de dar 0 porque no se logro la inserción de la data
        $this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users', [
            'email' => 'pmedina@zoho.com'
        ]);
    }

}
