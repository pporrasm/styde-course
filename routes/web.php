<?php


Route::get('/', function () {
    return view('welcome');
});


Route::get('/usuarios', function () {
    return 'Hola usuario' ;
});

Route::get('/usuarios/{id}', function ($id) {
    return 'Mostrando detalle del usuario '.$id;
})->where('id', '[0-9]+');

Route::get('/usuarios/nuevo', function (){
    return "Nuevo usuario";
});
?>