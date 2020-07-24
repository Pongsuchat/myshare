<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Users extends Eloquent
{
    protected $fillable =[
        'userName','countryCode','phoneNumber','password','role'

        
    ];

}

