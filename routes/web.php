<?php

Route::get('/', function () {
    return view('welcome');
});


Route::get('/usuarios', function () {
    return 'Hola usuario' ;
});


?>