<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Time extends Model
{
    protected $table ="trip";
    protected $fillable =[
        'timestamp'

        
    ];
}
