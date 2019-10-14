<?php

Route::get('/', function () {
    return view('welcome');
});


Route::get('/usuarios', function () {
    return 'Hola usuario' ;
});

Route::get('/usuarios/detalle/{id}', function ($id) {
    return 'Mostrando detalle del usuario '.$id;
});

?>