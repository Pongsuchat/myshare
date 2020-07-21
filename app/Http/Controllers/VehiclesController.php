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
            'approveDate' => date("Y-m-dTH:i:s\Z"),//ยังต้องแก้กรณี reject
        ];

    
        $vehicles = DB::table('vehicles')->where('_id',$vehicle_id)->update($data);
       
        $user_detail = DB::table('users')->where('_id',$user_id)->first();
        $deviceToken = $user_detail['deviceToken'];
        $recipientId = $user_detail['_id'];

        $notification = [
            'header' => 'My Share',
            'recipientId' => $recipientId,
            'message' => 'ได้อนุมัติการยืนยันรถยนต์ของคุณแล้ว',
            'deviceToken' => $deviceToken,
            'device' => 'backoffice',
            'notificationType' => 'approveVehicle',
            'timestamp' => date("Y-m-dTH:i:s\Z"),
            'data' => 'dataที่บอกให้สร้างเปล่าๆไว้ก่อน',
        ];
    
        $notification_update = DB::table('notification')->where('recipientId',$recipientId)->update($notification);
        if($notification_update){ 
        }else{
            
            $notification = [
                'header' => 'My Share',
                'recipientId' => $recipientId,
                'message' => 'ได้อนุมัติการยืนยันรถยนต์ของคุณแล้ว',
                'deviceToken' => $deviceToken,
                'device' => 'backoffice',
                'notificationType' => 'approveVehicle',
                'timestamp' => date("Y-m-dTH:i:s\Z"),
                'data' => 'dataที่บอกให้สร้างเปล่าๆไว้ก่อน',
            ];
           
            $notification_create =  DB::table('notification')->insert($notification); 
           
           
        }

        $vehicles_detail = DB::table('vehicles')->where('user_id',$user_detail['_id'])->get();

        // return view('adminusers.detailuser',[
        
        //     'user_detail' => $user_detail,
        //     'vehicles_detail' => $vehicles_detail,
        //     'vehicles_num' => $vehicles_detail->count()
        //     ]);    
        
        return redirect("usersdetail?id=$user_id");
        // return redirect("usersdetail?id=$user_id&id=vehicle");ส่ง id ไปฟังก์ชั่นอื่น
    }

    
}
