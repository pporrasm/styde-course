@extends('layout')
<!--Para evitar utilizar un include para el header y para el footer-->
<!--Sintaxis corta para PHP -->
@section('title', 'Listado de Usuarios')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-3">
            <h1 class="pb-1">{{ $title }}</h1>
            <p><a href="{{ route('users.create') }}" class="btn btn-success">Nuevo usuario</a></p>
        </div>
        <div class="table-responsive table-hover">
            @if($users->isNotEmpty())
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
                            <td>
                                {{--<a href="{{ route('users.show', ['id' => $user->id]) }}">
                                    <button type="button" class="btn btn-primary"><span class="oi oi-monitor"></span></button>
                                </a>
                                <a href="{{ route('users.edit', ['id' => $user->id]) }}">
                                    <button type="button" class="btn btn-primary"><span class="oi oi-pencil"></span>
                                    </button>
                                </a>--}}

                                <form action="{{route('users.destroy', $user) }}" method="post">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <a href="{{ route('users.show', $user)}}" class="btn btn-primary">
                                        <span class="oi oi-monitor"></span>
                                    </a>
                                    <a href="{{ route('users.edit', $user)}}" class="btn btn-success">
                                        <!-- LO PASO COMO EL MODELO DE ELOQUENT -->
                                        <span class="oi oi-pencil"></span>
                                    </a>
                                    <button type="submit" class="btn btn-warning"><span class="oi oi-trash"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <p> No existen usuarios registrados. </p>
                    @endforelse
                    </tbody>
                </table>
            @else
                <p> No existen usuarios registrados. </p>
            @endif
        </div>
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