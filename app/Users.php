<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Users extends Eloquent
{
    protected $fillable =[
        'userName','countryCode','phoneNumber','password','role'

        
    ];
}
