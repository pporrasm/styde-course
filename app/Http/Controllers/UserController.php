<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (\request()->has('empty')) {
           $users = [];
        } else {
            //uso de arreglo estatico
            $users = [
                'Juan','Pedro','Jose','Julian'
            ];
        }

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


        return view('users', compact('users', 'title'));
    }

    public function show($id)
    {
        //return "Mostrando detalle del usuario: {$id}";
        $title = "Detalles del usuario: {$id}";
        //dd(compact('id', 'title'));
        return view ('userdetails', compact('id', 'title'));
    }

    public function create()
    {
        //return "Nuevo usuario";
        $title = "Crear nuevo usuario";
        return view('createuser', compact('title'));
    }
    public function edit($id)
    {   
        if($id = 20){
            $name = "Pedro Porras";
            $username = "pporras";
            $email = "pporrasm@miumg.edu.gt";
        }
        //return "Editar usuario: {$id}";
        $title = "Editar usuario";
        return view ('edituser', compact('id','title','name', 'username', 'email'));
    }
}
