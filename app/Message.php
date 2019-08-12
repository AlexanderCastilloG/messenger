<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // para convetir un atributo en tipos de datos comunes, en este ejemplo en un boolean
    protected $casts = [
        'written_by_me' => 'boolean'
    ];
}
