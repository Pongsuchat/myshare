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
            // ['userPicture','']
        ])->get();

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

    $updateAt = new DateTime();
    $updateAt_insert = new \MongoDB\BSON\UTCDateTime($updateAt);

    // $datetimestamp = new DateTime();
    // $datetime_insert = new \MongoDB\BSON\UTCDateTime($datetimestamp);
    
    $data = [
       
        'status' => $status,
        'approveDate' => $updateAt_insert,
    ];

    $vehicles = DB::table('vehicles')->where('_id',$id)->update($data);
    
        return redirect('adminuser');
   }

   public function waitingforapprove()
   {
        $vehicles = Vehicles::where([
            ['status','pending'],
        ])
        ->join('users','vehicles.user_id','=','users._id')
        // ->select('users.*')
        ->get();

        
        // $users = DB::table('users')
        //     ->join('users', 'users.user_id', '=', 'contacts.user_id')
        //     ->join('orders', 'users.id', '=', 'orders.user_id')
        //     ->select('users.*', 'contacts.phone', 'orders.price')
        //     ->get();
        

        return view('view_menu.waitingforapprove',[
            
            'vehicles' => $vehicles
        
        ]);
   }

   
//    public function waitingforapprove()
//    {
//         $pendingvehicle = Vehicle::where([
//             ['status','pending'],
//             // ['userPicture','']
//         ])->get();

//         dd($pendingvehicle);
//         die;

//         return view('view_menu.waitingforapprove',[
            
//             'pendingvehicle' => $pendingvehicle
            
        
//         ]);

//    }
}
