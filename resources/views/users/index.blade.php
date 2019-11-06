@extends('layout')
<!--Para evitar utilizar un include para el header y para el footer-->
<!--Sintaxis corta para PHP -->
@section('title', 'Listado de Usuarios')

@section('content')
    <h1>{{ $title }}</h1>
    <div class="container">
        <a href="{{ route('users.create') }}" ><button type="button" class="btn btn-success">Nuevo Usuario</button></a>
    </div>
    <hr/>


    <div class="table-responsive table-hover">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{ $user->email }}</td>
                    <td><a href="{{ route('users.show', ['id' => $user->id]) }}">
                            <button type="button" class="btn btn-primary">Ver Detalles</button>
                        </a></td>
                    <td><a href="{{ route('users.edit', ['id' => $user->id]) }}">
                            <button type="button" class="btn btn-primary">Editar</button>
                        </a></td>
                </tr>
            @empty
                <p> No existen usuarios registrados. </p>
            @endforelse
            </tbody>
        </table>
    </div>


    {{--@forelse ($users as $user)
        <li>
            {{ $user->name }}. {{ $user -> email }}
            <a href="{{ url("/usuarios/{$user->id}") }}">Ver detalles</a>
            <a href="{{ url('/usuarios/'.$user->id) }}">Ver detalles de otro forma</a>
            <a href="{{ action('UserController@show', ['id' => $user->id]) }}">Ver detalles con action</a>
            <a href="{{ route('users.show', ['id' => $user->id]) }}">Ver detalles con Route</a>
        </li>
    @empty
        <p> No existen usaurios registrados. </p>
    @endforelse--}}


    <hr/>
@endsection