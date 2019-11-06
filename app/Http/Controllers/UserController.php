<?php

namespace App\Http\Controllers;


use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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

    public function edit(User $user)
    {
        /*if ($id = 20) {
            $name = "Pedro Porras";
            $username = "pporras";
            $email = "pporrasm@miumg.edu.gt";
        }
        //return "Editar usuario: {$id}";
        $title = "Editar usuario";
        return view('users.edit', compact('id', 'title', 'name', 'username', 'email'));*/
        //return view('users.edit', ['user' => $user]);
        //Creo una funcion anonima por el error -    'wasRecentlyCreated' => true
        //+    'wasRecentlyCreated' => false
        return view('users.edit', ['user' => $user]);
    }

    public function store(){
        //$data = \request()->only(['nema','emai','password']);

        //Para conservar los valores del form al haber un error.
        //return redirect('/usuarios/nuevo')->withInput();

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email', //reglas diferentes para validación, puede ser tambien en modo array.
            'password' => 'required|min:6',
        ], [
            'name.required' => 'El campo es obligatorio'
        ]);

        //dd($data);

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

    public function update(User $user){

        //$data = \request()->all();
        $data = \request()->validate(
            [
                'name' => 'required',
                /*'email' => 'required|email|unique:users,email,'.$user->id, //los parametros son table, columna, id que se desea excluir*/
                'email' => [
                    'required', 'email', Rule::unique('users')->ignore($user->id)
                ],
                'password' => '',]
        );

        if ($data['password'] != null){
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }
        //return redirect("/usuarios/{$user->id}");

        $user->update($data);
        return redirect()->route('users.show', ['user' => $user->id]);
    }
    public function destroy(User $user){
        $user->delete();
        return redirect(route('users.index'));
    }
}
