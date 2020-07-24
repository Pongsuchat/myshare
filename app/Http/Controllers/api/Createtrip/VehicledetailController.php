<?php

namespace App\Http\Controllers\api\Createtrip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image,Str,Storage;
use App\Http\Controllers\api\RegisterController;
use App\Http\Controllers\api\VehiclepictureController;
use DateTime;
use DateInterval;

class VehicledetailController extends Controller
{
    private function comparetoken($token)
    {
        $RegisterController = new RegisterController();
        return $RegisterController->comparetoken($token);
    }

    public function myVehicle(Request $request)
    {

      
        $userToken = $request->header('userToken');
        if ($this->comparetoken($userToken) === false) {
            return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                'status' => 403,
                'msg' => 'token is not found',
            ]);
            exit;
             
        }
        $user = DB::table('users')->where('userToken',$userToken)->first(); 
        $user_id =$user['_id']; 
        
        $my_vehicle = DB::table('vehicles')->where([
            ['user_id', '=', $user_id],
            ['status','=','approve']   
        ])->get();

        if ($my_vehicle->count()>0) {
            return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                'status' => 200,
                'msg' => 'OK',
                'data' => $my_vehicle,
            ]);
        }else {
            return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                'status' => 204,
                'msg' => 'ผู้ให้บริการยังไม่มียานพหนะ',
                
            ]);
        }
    }

    public function myDetailVehicle(Request $request)
    {
        $userToken = $request->header('userToken');
        $vehicle_id =$request->input('vehicle_id');

        if ($this->comparetoken($userToken) === false) {
            return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                'status' => 403,
                'msg' => 'token is not found',
            ]);
            exit;
        }

        $myvehicle_detail = DB::table('vehicles')->where('_id',$vehicle_id)->first();

        if ($myvehicle_detail) {
            
            return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                'status' => 200,
                'msg' => 'OK',
                'data' => $myvehicle_detail,
            ]);
        }else {
            return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                'status' => 204,
                'msg' => 'ไม่พบข้อมูลรถคันดังกล่าว',
                
            ]);
        }
    }

    public function editMyDetailVehicle(Request $request)
    {
        $userToken = $request->header('userToken');
        $vehicle_id =$request->input('vehicle_id');

        if ($this->comparetoken($userToken) === false) {
            return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                'status' => 403,
                'msg' => 'token is not found',
            ]);
            exit;
        }

        $json = $request->json()->all();
        $image_64 = $request->input('picture');
        $vehicleRegistration = $json['vehicleRegistration'];
        $vehicleBrand = $json['vehicleBrand'];
        $vehicleModel = $json['vehicleModel'];
        $vehicleColor = $json['vehicleColor'];
        $seat = $json['seat'];
        $actNo = $json['actNo'];
        $personalNumber = $json['personalNumber'];
        $insurance = $json['insurance'];
        $vehicleType = $json['vehicleType'];
        $weight = $json['weight']; 

        $user = DB::table('users')->where('userToken',$userToken)->first(); 
        $user_name = $user['userName'];
        $user_id = $user['_id'];
        
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
        $image = str_replace($replace, '', $image_64); 
        $image = str_replace(' ', '+', $image); 
        $imageName = Str::random(10).'.'.$extension;

        $path_folder = public_path("images/vehicleprofile/").$user_name."/";

       
        if (!file_exists( $path_folder))  
        { 
            mkdir($path_folder, 0777, true);
        } 
        
        $path = $path_folder.$imageName;
        $path_image = "/images/vehicleprofile/$user_name/$imageName";// แพทที่เก็บรูป

      
        if(file_put_contents($path ,base64_decode($image))){
            $img = Image::make(public_path($path_image));
            $img->insert(public_path('images/watermark/watermark.png'), 'center');
            $img->save(public_path($path_image));

            $updateAt = new DateTime();
            $updateAt_insert = new \MongoDB\BSON\UTCDateTime($updateAt);
              

            $data = [
                'vehiclePicture'=>$path_image,
                'vehicleBrand'=>$vehicleBrand,
                'vehicleRegistration'=>$vehicleRegistration,
                'vehicleModel'=>$vehicleModel,
                'vehicleColor'=>$vehicleColor,
                'seat'=>$seat,
                'actNo'=>$actNo,
                'personalNumber'=>$personalNumber,
                'insurance'=>$insurance,
                'vehicleType'=>$vehicleType,
                'weight'=>$weight,
                'updateAt'=> $updateAt_insert,
               
            ];
          
            $vehicles_fineuser = DB::table('vehicles')->where([['_id',$vehicle_id],])->first();
        
            @unlink(public_path($vehicles_fineuser['vehiclePicture']));
            
           
            $vehicles_edit = DB::table('vehicles')->where('_id',$vehicle_id)->update($data);


            if ($vehicles_edit) {
                // $myvehicle_update = DB::table('vehicles')->where('_id',$vehicle_id)->first();

                return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                    'status' => 200,
                    'msg' => 'OK',
                    
                ]);
            }else {
                return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                    'status' => 400,
                    'msg' => 'ข้อมูลการแก้ไขรถไม่ถูกต้อง ทำให้ไม่สามารถอนุมัติได้',
                    
                ]);
            }
        }
    }

    public function createVehicle(Request $request)
    {
        $userToken = $request->header('userToken');

        if ($this->comparetoken($userToken) === false) {
            return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                'status' => 403,
                'msg' => 'token is not found',
            ]);
            exit;
        }

        $user = DB::table('users')->where('userToken',$userToken)->first(); 
        $user_id = $user['_id'];

        $json = $request->json()->all();
        $image_64 = $request->input('picture');
        $vehicleRegistration = $json['vehicleRegistration'];
        $vehicleBrand = $json['vehicleBrand'];
        $vehicleModel = $json['vehicleModel'];
        $vehicleColor = $json['vehicleColor'];
        $seat = $json['seat'];
        $actNo = $json['actNo'];
        $personalNumber = $json['personalNumber'];
        $insurance = $json['insurance'];
        $vehicleType = $json['vehicleType'];
        $weight = $json['weight']; 

        $user = DB::table('users')->where('userToken',$userToken)->first(); 
        $user_name = $user['userName'];
        $user_id = $user['_id'];
        
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
        $image = str_replace($replace, '', $image_64); 
        $image = str_replace(' ', '+', $image); 
        $imageName = Str::random(10).'.'.$extension;

        $path_folder = public_path("images/vehicleprofile/").$user_name."/";

       
        if (!file_exists( $path_folder))  
        { 
            mkdir($path_folder, 0777, true);
        } 
        
        $path = $path_folder.$imageName;
        $path_image = "/images/vehicleprofile/$user_name/$imageName";// แพทที่เก็บรูป

      
        if(file_put_contents($path ,base64_decode($image))){
            $img = Image::make(public_path($path_image));
            $img->insert(public_path('images/watermark/watermark.png'), 'center');
            $img->save(public_path($path_image));

            $createAt = new DateTime();
            $createAt_insert = new \MongoDB\BSON\UTCDateTime($createAt);


            $data = [
                'vehiclePicture'=>$path_image,
                'vehicleBrand'=>$vehicleBrand,
                'vehicleRegistration'=>$vehicleRegistration,
                'vehicleModel'=>$vehicleModel,
                'vehicleColor'=>$vehicleColor,
                'seat'=>$seat,
                'actNo'=>$actNo,
                'personalNumber'=>$personalNumber,
                'insurance'=>$insurance,
                'vehicleType'=>$vehicleType,
                'weight'=>$weight,
                'image_status'=>'waiting',
                'user_id'=>$user_id,
                'user_id'=>$user_id,
                'status'=> 'new create',
                'createAt'=> $createAt_insert,
               
            ];
      
            $vehicles_create = DB::table('vehicles')->insert($data);


            if ($vehicles_create) {
                

                return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                    'status' => 200,
                    'msg' => 'OK',
                    
                ]);
            }else {
                return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                    'status' => 400,
                    'msg' => 'เพิ่มรถไม่สำเร็จกรุณาลองใหม่',
                    
                ]);
            }

        }

    }
}

