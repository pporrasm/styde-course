<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios', 'UserController@index')
    ->name('users.index');

Route::get('/usuarios/nuevo', 'UserController@create')
    ->name('users.create');

//Route::post('/usuarios/crear', 'UserController@store')
Route::post('/usuarios', 'UserController@store')
    ->name('users.store');

Route::get('/usuarios/{id}/edit', 'UserController@edit')->where('id', '[0-9]+');

//Utilizarse con el helper action
//Route::get('/usuarios/detalles/{id}', 'UserController@show');
//Route::get('/usuarios/{id}', 'UserController@show')
Route::get('/usuarios/{user}', 'UserController@show')
    ->where('user', '[0-9]+')
    ->name('users.show');

//->where('id', '[0-9]+'); Para parametros numericos
//->where('id', '\d'); Para parametros numericos
//->where('id', '\w'); Para parametros con numero y letras

//Agregar signo de interragación en el parametro que quiera que sea opcional
//Los valores son opcioens o valores por defecto que se colocan en la funcion
//Route::get('/saludo/{name?}/{nickname?}', 'WelcomeUserController@index'); cuando tenemos una clase que queremos llamar
//Pero si solo tenemos una lo dejamos solo con el nombre del controlador, la clase se llamara __invoke
Route::get('/saludo/{name?}/{nickname?}', 'WelcomeUserController');

Route::get('/usuarios/{user}/editar', 'UserController@edit')
    ->name('users.edit');

Route::put('/usuarios/{user}', 'UserController@update')
    ->name('users.update');
