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

    private function updateImage($data)
    {
        $user_db = $this->getUser($data['userToken']);
        $action = $data['action'];
        $path_image = $data['path'];
        // return $user_db['_id'] ;
        $data = [
            $action=>$path_image
        ];
        $user = DB::table('vehicles')->where('user_id',$user_db['_id'])->update($data);
        if($user){
            return response()->json([
                'status'=>200,
                'msg'=>'Upload success-update',
 
            ]);
        }else{
            // $add_user_id = array('user_id'=>$user_db['_id']);
            $data = [
                $action=>$path_image,
                'user_id'=>$user_db['_id']
            ];
            // array_push($data,$add_user_id);
            // $data = [
            //     $data['action']=>$data['path'],
            //     'user_id'=>$user_db['_id']
            // ];
            // return response()->json($data_insert);
            // die;
            $user1 = DB::table('vehicles')->where('user_id',$user_db['_id'])->insert($data);
            if($user1){
                return response()->json([
                    'status'=>200,
                    'msg'=>'Upload success-insert',
     
                ]); 
            }
        }
    }



    private function uploadImageCenter($data)
    {
        $filename = $this->randomName($data);
        $path = $this->pathFile($data);
        $path_image = $path.$filename;
        $moveImage = $data->file('picture')->move(public_path($path),$filename);
        $data_update = [
            'path'=>$path_image,
            'action'=>$data->input('action'),
            'userToken'=>$data->input('userToken')
        ];
        return $this->updateImage($data_update);

        // return response()->json($path, 200);
    }

    public function uploadvehicleImage(Request $request)
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

        // $action = $request->input('action');
        // if($action=='driverLicensePicture'){
        
        return $this->uploadImageCenter($request);
            // return response()->json(now(), 200);
        // }
        

    //     die;
    //     $user = DB::table('users')->where('userToken', $userToken)->first();

    //     @unlink(public_path($user['driverLicensePicture']));
    //     $driverlicense = $request->file('driverlicense');
    //     $new_name = rand() . '.' . $request->driverlicense->extension();
    //     $path_image = "/images/vehicleprofile//155" . $new_name;
    //     $driverlicense->move("images/vehicleprofile/155/", $new_name);

    //     $insert = DB::table('vehicles')->insert([
    //         'driverLicensePicture' => $path_image, 'user_id' => $user['_id']
    //     ]);
        
    
    //     if( $insert){
    //             return response()->json([
    //                'status'=>200,
    //                'msg'=>'Upload success'   
    //            ]);
            
    //     } else {
    //         return response()->json([
    //             'status' => 500,
    //             'msg' => 'Upload Failed',
    //         ]);
    //     }

        

     }
}