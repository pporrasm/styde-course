@extends('layout')
<!--Para evitar utilizar un include para el header y para el footer-->
<!--Sintaxis corta para PHP -->
@section('title', 'Listado de Usuarios')

@section('content')
    <h1>{{ $title }}</h1>
    <hr/>
    <ul>
        @forelse ($users as $user)
            <li>
                {{ $user->name }}. {{ $user -> email }}
                <a href="{{ url("/usuarios/{$user->id}") }}">Ver detalles</a>
                <a href="{{ url('/usuarios/'.$user->id) }}">Ver detalles de otro forma</a>
                <a href="{{ action('UserController@show', ['id' => $user->id]) }}">Ver detalles con action</a>
                <a href="{{ route('users.show', ['id' => $user->id]) }}">Ver detalles con Route</a>
            </li>
        @empty
            <p> No existen usaurios registrados. </p>
        @endforelse
    </ul>

    <hr/>
@endsection