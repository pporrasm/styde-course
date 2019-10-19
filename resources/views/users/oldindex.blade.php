@extends('layout')
<!--Para evitar utilizar un include para el header y para el footer-->
<!--Sintaxis corta para PHP -->
@section('title', "{$title}")
@section('content')

    <h1>{{ $title }}</h1>
    <hr>
    <h2>if</h2>
    @if (! empty($users))
        <ul>
            @foreach ($users as $user)
                <li>{{ $user->name }}. {{ $user -> email }}</li>
            @endforeach
        </ul>
    @else
        <p> No existen usaurios registrados. </p>
    @endif

    <hr>
    <h2>unless</h2>
    @unless (empty($users))
        <ul>
            @foreach ($users as $user)
                <li>{{ $user->name }}</li>
            @endforeach
        </ul>
    @else
        <p> No existen usaurios registrados. </p>
    @endunless

    <hr>
    <h2>empty</h2>
    @empty($users)
        <p> No existen usaurios registrados. </p>
    @else
        <ul>
            @foreach ($users as $user)
                <li>{{ $user->name }}</li>
            @endforeach
        </ul>
    @endempty

    <hr>
    <h2>forelse</h2>
    <ul>
        @forelse ($users as $user)
            <li>{{ $user->name }}</li>
        @empty
            <p> No existen usaurios registrados. </p>
        @endforelse
    </ul>
@endsection