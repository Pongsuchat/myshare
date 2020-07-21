<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tripprice_travel extends Eloquent
{
    // protected $table = 'tripprice_travel';
    protected $fillable =[
        'priceRate'

        
    ];
}
