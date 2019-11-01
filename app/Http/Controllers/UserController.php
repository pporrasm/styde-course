<?php

namespace App\Http\Controllers;


use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        /**if (\request()->has('empty')) {
         * $users = [];
         * } else {
         * //uso de arreglo estatico
         * $users = [
         * 'Juan','Pedro','Jose','Julian'
         * ];
         * }
         * dd () Helper de debug de laravel similar al var_dump
         * dd(compact('users','title'));
         *
         * return 'Hola usuario' ;
         * return view('users', [
         * 'users'=>$users,
         * 'title'=> 'Listado de Usuarios!'
         * ]);  Envio de variables implicitamente
         * return view('users')->with([
         * 'users'=>$users,
         * 'title'=> 'Listado de Usuarios!'
         * ]); Envio con el argunto with
         * return view('users')->with('users', $users)->with('title', 'Listado de Usuarios!');*/


        //$users = DB::table('users')->get();
        //uso de eloquent
        $users = User::all();
        //dd($users);
        $title = "Listado de usuarios!";

        //Forma alternativa.
        /**
         * return view('users.index')
         * ->with('users', User::all())
         * ->with('title', 'Listado de usuarios');*/

        return view('users.index', compact('title', 'users'));
    }

    /**$user = User::find($id);
     * if ($user == null){
     * return response()->view('errors.404',[],404);
     * }*/
    /**
     * //dd($user);
     * //$title = "Detalles del usuario: {$id}";
     * //dd(compact('id', 'title'));
     * //return view ('user.show', compact('id', 'title'));
     * //Automaticamente se finaliza la ejecución y publica 404 page
     * $user = User::findOrFail($id);
     * return view ('users.show', compact( 'user', 'title'));
     * }*/


    public function show(User $user)
    {
        $title = "Detalles del usuario: {$user->id}";
        //dd($user;

        return view('users.show', compact('user','title'));
    }

    public function create()
    {
        //return "Nuevo usuario";
        $title = "Crear nuevo usuario";
        return view('users.create', compact('title'));
    }

    public function edit($id)
    {
        if ($id = 20) {
            $name = "Pedro Porras";
            $username = "pporras";
            $email = "pporrasm@miumg.edu.gt";
        }
        //return "Editar usuario: {$id}";
        $title = "Editar usuario";
        return view('users.edit', compact('id', 'title', 'name', 'username', 'email'));
    }

    public function store(){
        //$data = \request()->only(['nema','emai','password']);

        //return redirect('/usuarios/nuevo')->withInput();

        $data = request()->validate([
            'name' => 'required'
        ], ['name.required' => 'El campo es obligatorio']);

        //si no se utilizara el metodo valitate de laravel
        $data = \request()->all();
        /*if (empty($data['name'])){
            return redirect('usuarios/nuevo')->withErrors([
                'name' => 'El campo es obligatorio'
            ]);
        }*/

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        return redirect()->route('users.index');
        //return view('users.store');
    }
}
