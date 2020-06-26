<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use App\Vehicles;

class DashboardController extends Controller
{
   public function index()
   {
    $alluser = Users::all();
    $vehicles = Vehicles::all();

      // return $vehicles;
   //  return view('index',['allusers'=>$data]);
   return view('vehicles',[
      
      'allvehicles'=>$vehicles,
      'alluser' => $alluser
   
   
   ]);
   }
}
