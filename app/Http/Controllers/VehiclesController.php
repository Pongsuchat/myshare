<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class VehiclesController extends Controller
{
    public function updatestatus(Request $request)
    {
        
        $vehicle_id = $request->get('vehicle_id');
        $user_id = $request->get('user_id');
        $status = $request->get('status');


        $data = [
           
            'status' => $status,
            'approveDate' => date("Y-m-dTH:i:s\Z"),
        ];

        
    
        $vehicles = DB::table('vehicles')->where('_id',$vehicle_id)->update($data);
       
       
        $user_detail = DB::table('users')->where('_id',$user_id)->first();
        
        $vehicles_detail = DB::table('vehicles')->where('user_id',$user_detail['_id'])->get();
        
        
        
    

        
        return view('adminusers.detailuser',[
        
            'user_detail' => $user_detail,
            'vehicles_detail' => $vehicles_detail,
            'vehicles_num' => $vehicles_detail->count()
            ]);    
        
        
    }
}
