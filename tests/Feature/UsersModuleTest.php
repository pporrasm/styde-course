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
            ->assertSee('No existen usuarios registrados.');
    }

    /**
     * @test
     */
    function prueba_de_carga_detalle_usuario()
    {
        $user = factory(User::class)->create(['name' => 'Pedro Porras']);
        $this->get('/usuarios/' . $user->id)
        //$this->get("{/usuarios/{$user->id}")
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

    /**
     * @test
     */
    function email_is_requered()
    {
        //$this->withoutExceptionHandling();
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Pedro',
                'email' => '',
                'password' => '123455'
            ])->assertRedirect('/usuarios/nuevo')
            ->assertSessionHasErrors(['email' ]);

        // Debe de dar 0 porque no se logro la inserción de la data
        $this->assertEquals(0, User::count());


    }
    /**
 * @test
 */
    function email_must_be_valid()
    {
        //$this->withoutExceptionHandling();
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Pedro',
                'email' => 'correo-no-valido',
                'password' => ''
            ])->assertRedirect('/usuarios/nuevo')
            ->assertSessionHasErrors(['email' ]);

        // Debe de dar 0 porque no se logro la inserción de la data
        $this->assertEquals(0, User::count());


    }
    /**
     * @test
     */
    function email_must_be_unique()
    {
        //$this->withoutExceptionHandling();
        factory(User::class)->create([
            'email' => 'pmedina@zoho.com'
        ]);

        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Pedro',
                'email' => 'pmedina@zoho.com',
                'password' => '12345'
            ])->assertRedirect('/usuarios/nuevo')
            ->assertSessionHasErrors(['email' ]);

        // Debe de dar 0 porque no se logro la inserción de la data
        $this->assertEquals(1, User::count());


    }


    /**
     * @test
     */
    function password_is_requered()
    {
        //$this->withoutExceptionHandling();
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Pedro',
                'email' => 'pmedina@zoho.com',
                'password' => ''
            ])->assertRedirect('/usuarios/nuevo')
            ->assertSessionHasErrors(['password' ]);

        // Debe de dar 0 porque no se logro la inserción de la data
        $this->assertEquals(0, User::count());


    }
    /**
     * @test
     */
    function carga_pagina_edition(){
        $user = factory(User::class)->create();
        $this->withoutExceptionHandling();

        $this->get("/usuarios/{$user->id}/editar") // URL esperada usuarios/5/editar
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('Editar usuario')
            //->assertViewHas('user', $user);//forza que la vista contenga el objeto user
            ->assertViewHas('user', function ($viewUser) use ($user) {
                return $viewUser->id === $user->id;});//forza que la vista contenga el objeto user
    }

    /**
     * @test
     */
    function it_update_user()
    {
        $user = factory(User::class)->create();

        $this->withoutExceptionHandling();
        $this->put("/usuarios/{$user->id}", [
            'name' => 'Pablo',
            'email' => 'pmedina@zoho.com',
            'password' => '123455'
            //])->assertSee('Procesando información');
            //])->assertRedirect('usuarios');
        ])->assertRedirect("/usuarios/{$user->id}");


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
    function updating_name_required(){
        $user = factory(User::class)->create();

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}",[
            'name' => '',
            'email' => 'pmedina@zoho.com',
            'password' => '123455'
        ])->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', ['email' => 'pmedina@zoho.com',]);
    }

    /**
     * @test
     */
    function update_email_is_requered()
    {
        $user = factory(User::class)->create();

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}",[
                'name' => 'Pedro',
                'email' => '',
                'password' => '123455'
            ])->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name' => 'Pedro',]);


    }
    /**
     * @test
     */
    function update_email_must_be_valid()
    {
        $user = factory(User::class)->create();

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}",[
                'name' => 'Pedro',
                'email' => 'pmedina',
                'password' => '123455'
            ])->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name' => 'Pedro',]);


    }
    /**
     * @test
     */
    function update_email_must_be_unique()
    {
        //$this->withoutExceptionHandling();
        factory(User::class)->create([
            'email'=>'existe@mail.com'
        ]);

        $user = factory(User::class)->create([
            'email' => 'pmedina@zoho.com'
        ]);

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => 'Pedro',
                'email'=>'existe@mail.com',
                'password' => '12345'
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email' ]);

        // Debe de dar 0 porque no se logro la inserción de la data
        //$this->assertEquals(1, User::count());


    }



    /**
     * @test
     */
    function update_user_email_unique_edit()
    {
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create(
            [  'email' => 'pmedina@zoho.com',]
        );

        $this->from("usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Pedro',
                'email' => 'pmedina@zoho.com',
                'password' => '123456'
            ])->assertRedirect("usuarios/{$user->id}");

        // Debe de dar 0 porque no se logro la inserción de la data

        $this->assertDatabaseHas('users',[
            'name' => 'Pedro',
            'email' => 'pmedina@zoho.com',
        ]);


    }

    /**
     * @test
     */
    function update_password_is_optional()
    {
        //$this->withoutExceptionHandling();
        $oldpassword = 'CLAVE_ANTERIOR';
        $user = factory(User::class)->create(
            ['password' => bcrypt($oldpassword)]
        );

        $this->from("usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Pedro',
                'email' => 'pmedina@zoho.com',
                'password' => ''
            ])->assertRedirect("usuarios/{$user->id}");

        // Debe de dar 0 porque no se logro la inserción de la data
        $this->assertCredentials(['name' => 'Pedro',
            'email' => 'pmedina@zoho.com',
            'password' => $oldpassword]);


    }

    /**
     * @test
     */
    function it_delete_a_user(){
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $this->delete("usuarios/{$user->id}")
            ->assertRedirect('usuarios');

        $this->assertDatabaseMissing('users', [
            'email' => 'pporras@zoho.com'
        ]);

        $this->assertSame(0, User::count());
    }
}