@extends('layout')
<!--Para evitar utilizar un include para el header y para el footer-->
<!--Sintaxis corta para PHP -->

@section('content')
    <div class="container">
        <h2>Editar usuario</h2>
        @if ($errors->any())
            <h4>Corregir los siguientes errores</h4>
            <div class="alert alert-danger">
                <!-- Directiva para errores en general -->
                @foreach($errors->all() as $error)
                    <ul>
                        <li>{{$error}}</li>
                    </ul>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ url("usuarios/{$user->id}") }}" >
            {{{ method_field('PUT') }}}
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" id="formName" placeholder="Text input" name="name"
                       value="{{ old('name', $user->name) }}">
                <!-- Directiva para errores de por campo -->
                @if($errors->has('name'))
                    <p>{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input  name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email" value="{{ old('email', $user->email) }}">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar usuario</button>
            <a class="btn btn-link" href="{{ route('users.index') }}">
                <button type="button" class="btn btn-warning">Cancelar</button>
            </a>
        </form>
    </div>

@endsection
