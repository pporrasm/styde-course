<?php


Route::get('/', function () {
    return view('welcome');
});


Route::get('/usuarios', function () {
    return 'Hola usuario' ;
});

Route::get('/usuarios/nuevo', function (){
    return "Nuevo usuario";
});

Route::get('/usuarios/{id}', function ($id) {
    return 'Mostrando detalle del usuario '.$id;
});
//->where('id', '[0-9]+'); Para parametros numericos
//->where('id', '\d'); Para parametros numericos
//->where('id', '\w'); Para parametros con numero y letras

//Agregar signo de interragación en el parametro que quiera que sea opcional
Route::get('/saludo/{name}/{nickname?}', function ($name,$nickname=null){
    if ($nickname != null){
    return "Hola {$name}, tu apodo es {$nickname}";   
    } else{
        return "Hola {$name}, no tienes apodo";

    }
});

?>