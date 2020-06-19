<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\api\RegisterController;

class VehicleconfirmController extends Controller
{

    private function comparetoken($token)
    {
        $RegisterController = new RegisterController();
        return $RegisterController->comparetoken($token);
    }
    public function vehicleconfim(Request $request)
    {

        

        $vehecleprofile = $request->file('vehecleprofile');
        $userToken = $request->input('userToken');
        if($this->comparetoken($userToken)===false){
            return response()->json([
                'status'=>404,
                'msg'=>'token is not found'
            ]);
            exit;
        }
        

        
        $user = DB::table('users')->where('userToken',$userToken)->first();

        if($user){
            if($userToken == $user['userToken']){
                $update = DB::table('users')->where('phoneNumber', $phoneNumber)->insert([
                    'userToken' => $token, 'deviceToken' => $deviceToken,

                
                        ]);
                        if($update){
                            return response()->json([
                               'status'=>200,
                               'msg'=>'Upload success'   
                           ]);
                        }
            }else{
                return response()->json([
                    'status'=>500,
                    'msg'=>'Upload Failed',
                ]);
            }
        }else{
            return response()->json([
                'status'=>404,
                'msg'=>'usertoken not found',
            ]);
        }
    }

}
