<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\RegisterController;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class VehicleconfirmController extends Controller
{

    private function comparetoken($token)
    {
        $RegisterController = new RegisterController();
        return $RegisterController->comparetoken($token);
    }
    public function vehicleprofileconfirm(Request $request)
    {
        $vehicleprofilepicture = $request->file('vehicleprofilepicture');
        $userToken = $request->input('userToken');
        if ($this->comparetoken($userToken) === false) {
            return response()->json([
                'status' => 404,
                'msg' => 'token is not found',
            ]);
            exit;
        }



        $user = DB::table('users')->where('userToken', $userToken)->first();

        @unlink(public_path($user['vehiclePicture']));
        $vehicleprofilepicture = $request->file('vehicleprofilepicture');
        $new_name = rand() . '.' . $request->vehicleprofilepicture->extension();
        $path_image = "/images/vehicleprofile/155/" . $new_name;
        $vehicleprofilepicture->move("images/vehicleprofile/155/", $new_name);

       
        $vehicle_user_id = DB::table('vehicles')->where('user_id',$user['_id'])->first();
        if($userToken == $user['_id']){

            $update=DB::table('vehicles')->where('user_id',$user['_id'])->update([
                'vehiclePicture'=>$path_image 
                ]);
                return response()->json([
                   'status'=>200,
                   'msg'=>'Upload success'   
               ]);
            
        } 
        // elseif {
        //     $insert = DB::table('vehicles')->insert([
        //         'vehiclePicture' => $path_image, 'user_id' => $user['_id']
        //     ]);
        //     return response()->json([
        //         'status'=>200,
        //            'msg'=>'Upload success'
        //     ]);
        // } else{
        //     return response()->json([
        //         'status' => 500,
        //         'msg' => 'Upload Failed',
        //     ]);

        // }

        

    }
    private function randomName($request)
    {
        return  rand(). '.' . $request->picture->extension(); 
    }

    private function getUser($userToken){
        $user = DB::table('users')->where('userToken',$userToken)->first();
        return $user;
    }

    private function pathFile($request)
    {
        $username = $this->getUser($request->input('userToken'));
        $path_image = "/images/vehicleprofile/".$username['userName'].'/';
        return $path_image;
        // return  rand(). '.' . $request->picture->extension(); 
    }




    private function driverlicense($data)
    {
        $filename = $this->randomName($data);
        $path = $this->pathFile($data);
        $path_image = $path.$filename;
        $image_store = $data->picture->move($path_image,$filename);
        return response()->json([$image_store], 200);
    }

    public function driverlicenseconfirm(Request $request)
    {
        $driverlicense = $request->file('driverlicense');
        $userToken = $request->input('userToken');
        if ($this->comparetoken($userToken) === false) {
            return response()->json([
                'status' => 404,
                'msg' => 'token is not found',
            ]);
            exit;
        }

        $action = $request->input('action');
        if($action=='driverLicensePicture'){
            return $this->driverlicense($request);
            // return response()->json($request->picture->path(), 200);
        }
        

        die;
        $user = DB::table('users')->where('userToken', $userToken)->first();

        @unlink(public_path($user['driverLicensePicture']));
        $driverlicense = $request->file('driverlicense');
        $new_name = rand() . '.' . $request->driverlicense->extension();
        $path_image = "/images/vehicleprofile//155" . $new_name;
        $driverlicense->move("images/vehicleprofile/155/", $new_name);

        $insert = DB::table('vehicles')->insert([
            'driverLicensePicture' => $path_image, 'user_id' => $user['_id']
        ]);
        
    
        if( $insert){
                return response()->json([
                   'status'=>200,
                   'msg'=>'Upload success'   
               ]);
            
        } else {
            return response()->json([
                'status' => 500,
                'msg' => 'Upload Failed',
            ]);
        }

        

    }
}
