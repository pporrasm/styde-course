<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    //public function index($name = null,$nickname=null){
    //La clase __invoke permite que esta clase sea la que esta por defecto.
    public function __invoke($name = null, $nickname = null)
    {
        $name = ucfirst($name);
        if ($name == null) {
            return "No se encontraron valores";
        } else {
            if ($nickname != null) {
                return "Hola {$name}, tu apodo es {$nickname}";
            } else {
                return "Hola {$name}";
            }
        }
    }
}
