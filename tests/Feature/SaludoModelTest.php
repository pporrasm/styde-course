<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaludoModelTest extends TestCase
{
   /** @test Pruebas de saludos */
   function it_user_with_nickname(){
        $this->get('saludo/pedro/shushin')
        ->assertStatus(200)
        ->assertSee("Hola Pedro, tu apodo es shushin");      
   }

   function it_user_without_nickname(){
    $this->get('saludo/pedro')
    ->assertStatus(200)
    ->assertSee("Hola Pedro");      
    }
}
