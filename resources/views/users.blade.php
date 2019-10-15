<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Usuarios</title>
</head>
<body>
    <!--Sintaxis corta para PHP -->
    <h1>{{ $title }}</h1>
    <hr>
    <h2>if</h2>
    @if (! empty($users))
        <ul>
            @foreach ($users as $user)
                <li>{{ $user }}</li>
            @endforeach
        </ul>
    @else
        <p> No existen usuarios registrados </p>
    @endif

    <hr>
    <h2>unless</h2>
    @unless (empty($users))
        <ul>
            @foreach ($users as $user)
                <li>{{ $user }}</li>
            @endforeach
        </ul>
    @else
        <p> No existen usuarios registrados </p>
    @endunless

    <hr>
    <h2>empty</h2>
    @empty($users)
        <p> No existen usuarios registrados </p> 
    @else
        <ul>
            @foreach ($users as $user)
                <li>{{ $user }}</li>
            @endforeach
        </ul>
    @endempty

    <hr>
    <h2>forelse</h2>
    <ul>
        @forelse ($users as $user)
            <li>{{ $user }}</li>
        @empty
            <p> No existen usuarios registrados </p> 
        @endforelse
    </ul>

</body>
</html>