<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    protected $hidden = [
        'password', 'remember_token',
    ];

    //Para convertir de entero a booleano
    protected $casts = [
        'isadmin' => 'boolean'
    ];

    public static function emailFind($email){
        return User::where(compact('email'))->first();
    }

    public function isAdmin(){
        return $this->email ==='pporras@pm.me';
    }



}
