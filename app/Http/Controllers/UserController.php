<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        /**if (\request()->has('empty')) {
           $users = [];
        } else {
            //uso de arreglo estatico
            $users = [
                'Juan','Pedro','Jose','Julian'
            ];
        }
        dd () Helper de debug de laravel similar al var_dump
        dd(compact('users','title'));

        return 'Hola usuario' ;
        return view('users', [
            'users'=>$users,
            'title'=> 'Listado de Usuarios!'
        ]);  Envio de variables implicitamente
        return view('users')->with([
            'users'=>$users,
            'title'=> 'Listado de Usuarios!' 
        ]); Envio con el argunto with
        return view('users')->with('users', $users)->with('title', 'Listado de Usuarios!');*/


        //$users = DB::table('users')->get();
        //uso de eloquent
        $users = User::all();
        //dd($users);
        $title = "Listado de usuarios!";

        //Forma alternativa.
       /**
        * return view('users.index')
            ->with('users', User::all())
            ->with('title', 'Listado de usuarios');*/

        return view('users.index', compact('users', 'title'));
    }

    public function show($id)
    {
        //return "Mostrando detalle del usuario: {$id}";
        $title = 'Detalle de usuarios';
        $user = User::find($id);
        //dd($user);
        //$title = "Detalles del usuario: {$id}";
        //dd(compact('id', 'title'));
        //return view ('user.show', compact('id', 'title'));
        return view ('users.show', compact( 'user', 'title'));
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
        return view ('users.edit', compact('id','title','name', 'username', 'email'));
    }
}
