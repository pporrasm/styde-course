<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return 'Hola usuario' ;
    }

    public function show($id){
        return "Mostrando detalle del usuario: {$id}";
    }

    public function create(){
        return "Nuevo usuario";

    }
    public function edit($id){
        return "Editar usuario: {$id}";
    }
}
