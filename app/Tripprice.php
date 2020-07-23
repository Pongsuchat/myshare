<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
// use Illuminate\Notifications\Notifiable;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class Tripprice extends Model
{
    protected $table = 'tripprice';
    protected $fillable = [
        'travel','deliver'
    ];
}
