<?php

namespace App\Http\Controllers\api\Createtrip;

use App\Http\Controllers\api\RegisterController;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;


class CreatetripController extends Controller
{
    private function comparetoken($token)
    {
        $RegisterController = new RegisterController();
        return $RegisterController->comparetoken($token);
    }

    public function createTrip(Request $request)
    {
                 
        $userToken = $request->header('userToken');
        if ($this->comparetoken($userToken) === false) {
            return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                'status' => 403,
                'msg' => 'token is not found',
            ]);
            exit;
             
        }
        $json = $request->json()->all();
        $tripFrom = $json['tripFrom'];
        $tripTo = $json['tripTo'];
        $stopPoint = $json['stopPoint'];
        $distance = $json['distance'];
        $tripType = $json['tripType'];
        $supplieSize = $json['supplieSize'];
        $supplieQuantity = $json['supplieQuantity'];
        $supplieWeight = $json['supplieWeight'];
        $remark = $json['remark']; 

        $user = DB::table('users')->where('userToken',$userToken)->first();
        $driverId = $user['_id'];
        $tripId =   $user['userName'].rand(); 

        $trip_data = [
        
            'tripId' =>$tripId,
            'tripFrom' => $json['tripFrom'],
            'tripTo' => $json['tripTo'],
            'stopPoint' => $json['stopPoint'],
            'distance' => $json['distance'],
            'tripType' => $json['tripType'],
            'supplieSize' => $json['supplieSize'],
            'supplieQuantity' => $json['supplieQuantity'],
            'supplieWeight' => $json['supplieWeight'],
            'remark' => $json['remark'],
            'tripId' =>$tripId,
            'tripStatus' => 'pending',
            'timestamp' => date("Y-m-dTH:i:s\Z"),
        ];


       $trip_insert = DB::table('trip')->insert($trip_data);
        if ($trip_insert) {
            return response()->json([
                'status' => 200,
                'msg' => 'OK',
                
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'msg' => 'ข้อมูลการสร้าง trip ไม่ถูกต้อง ทำให้ไม่สามารถอนุมัติสร้างได้',

            ]);
        }
    }
}
