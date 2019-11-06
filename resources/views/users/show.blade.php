<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalles de Usuario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>
<body>
<section class="section">
    <div class="container">
        <h1 class="title">
            {{ $title }}
        </h1>
        <p class="subtitle">
            ID usuario {{ $user->id }}
        </p>
        <p class="subtitle">
            Nombre: {{ $user->name }}
        </p>
        <p class="subtitle">
            Email: {{ $user->email }}
        </p>
        <p>
            {{--<a href="{{ url("/usuarios") }}">Regresar</a><br/>
            <a href="{{ url()->previous() }}">Regresar a pagina previa</a><br/>
            <a href="{{ action('UserController@index') }}">Regresar a con el controller</a><br/>--}}
            <a href="{{ route('users.index') }}">Regresar a con Route</a><br/>
            <a href="{{ route('users.edit', ['id' => $user->id]) }}">Editar con rutas</a><br/>

        </p>
    </div>
</section>
</body>
</html>