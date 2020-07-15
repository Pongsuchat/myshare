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
        // $tripId =  rand(). '.' . $request->picture->extension(); 

        $user = DB::table('users')->where('userToken',$userToken)->first();
        $driverId = $user['_id'];
        $tripId =  rand(). '.' . $request->picture->extension(); 


        $data = [
        
            'userName' => $json['userName'],
            'phoneNumber' => $json['phoneNumber'],
            'password' => Hash::make($password),
            'deviceToken' => $deviceToken,
            'userToken' => $token,
            'role' => "Normal User",
            'status' => "New user",
            'images_status'=> "waiting",
            'created' => date("Y-m-dTH:i:s\Z"),
        
        ];


        return response()->json([
                    'status'=>200,
                    'msg'=>$supplieWeight
                ]); die;
    }
}
