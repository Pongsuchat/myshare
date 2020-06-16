<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;

class DashboardController extends Controller
{
   public function index()
   {
    $data = Users::all();

    return view('index',['allusers'=>$data]);
   }
}
