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
        'is_admin' => 'boolean'
    ];

    public static function emailFind($email){
        return User::where(compact('email'))->first();
    }

        //profession_id
    public function profession(){
        //Si no se usan las conveciones por ejemplo que fuera id_profession
        ///return $this->belongsTo(Profession::class, 'id_profession');
        return $this->belongsTo(Profession::class);
    }

    public function isAdmin(){
        return $this->is_admin;
    }


}
