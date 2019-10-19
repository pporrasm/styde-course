<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    //Prueba de modelos con eloquent
    protected $fillable = [
        'title'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
    
}
