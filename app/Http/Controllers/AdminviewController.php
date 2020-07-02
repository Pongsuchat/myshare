<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use DB;
use App\Vehicles;


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

    // $user_detail = DB::table('users')
    //         ->join('vehicles', 'users.id', '=', 'vehicles.user_id')
    //         // ->join('orders', 'users.id', '=', 'orders.user_id')
    //         ->select('users.*', 'vehicles.*', 'orders.price')
    //         ->get();
    // foreach ($allusers as $key => $value) {
    //     echo $value['_id'],'<br>';
    // }
    // dd($allusers);
    // die;

    return view('view_menu.usersview',[
        
        'allusers' => $allusers
        
    
    ]);

   }

   public function createuseradmin(Request $request)
   {
    $request->validate([
        'userName' => 'required',
        'phoneNumber' => 'required',
        'password' => 'required',
        
    ]);
    $data = new Users ([
        'userName' => $request->get('userName'),
        'phoneNumber' => $request->get('phoneNumber'),
        'password' => $request->get('password'),
        'role' => 'Admin', 
        'created' => date("Y-m-dTH:i:s\Z"),
    ]);

    $data->save();
    
        return redirect('adminuser');
   }

   public function usersdetail(Request $request)
   {
    $id = $request->get('id');
        
    

    $user_detail = DB::table('users')->where('_id',$id)->first();
    $vehicles_detail = DB::table('vehicles')->where('user_id',$user_detail['_id'])->get();
    
  
     return view('adminusers.detailuser',[
        
        'user_detail' => $user_detail,
        'vehicles_detail' => $vehicles_detail,
        'vehicles_num' => $vehicles_detail->count()
        
        
    
    ]);

   }



   public function editadmin(Request $request)
   {$id = $request->input('id');
    $status = $request->input('status');
    
    $data = [
       
        'status' => $status,
        'approveDate' => date("Y-m-dTH:i:s\Z"),
    ];

    $vehicles = DB::table('vehicles')->where('_id',$id)->update($data);
    
        return redirect('adminuser');
   }

   public function waitingforapprove()
   {
        $vehicles = Vehicles::where([
            ['status','pending'],
        ])->get();
        

        return view('view_menu.waitingforapprove',[
            
            'vehicles' => $vehicles
        
        ]);
   }
}
