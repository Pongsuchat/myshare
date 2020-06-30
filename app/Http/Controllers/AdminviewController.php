<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use DB;

class AdminviewController extends Controller
{
    public function adminuser()
   {
        $allusers = Users::where([
            ['role','Admin'],
        ])->get();
        

        return view('view_menu.adminsview',[
            
            'allusers' => $allusers
        
        ]);
   }
   public function narmoluser()
   {
    $allusers = Users::where([
        ['role','Normal User'],
    ])->get();

    $user_detail = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();

    dd($user_detail);
    die;

    return view('view_menu.adminsview',[
        
        'allusers' => $allusers
        
    
    ]);

   }
}
