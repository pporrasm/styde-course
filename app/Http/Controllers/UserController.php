<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        //uso de arreglo estatico
        $users = [
            'Juan',
            'Pedro',
            'Jose',
            'Julian',
            '<script>alert("CLicker")</script>'
        ];
        $title = "Listado de usuarios!";

        //dd () Helper de debug de laravel similar al var_dump
        //dd(compact('users','title'));

        //return 'Hola usuario' ;
        /**return view('users', [
            'users'=>$users,
            'title'=> 'Listado de Usuarios!'
        ]);  Envio de variables implicitamente**/
        /**return view('users')->with([
            'users'=>$users,
            'title'=> 'Listado de Usuarios!' 
        ]); Envio con el argunto with**/
        //return view('users')->with('users', $users)->with('title', 'Listado de Usuarios!');
   

        return view('users', compact('users','title'));
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
