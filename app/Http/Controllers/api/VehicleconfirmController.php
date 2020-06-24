<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\RegisterController;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Image;

class VehicleconfirmController extends Controller
{

    private function comparetoken($token)
    {
        //ฟังกืชั่นเทียบ token มีใน DB ไหม
        $RegisterController = new RegisterController();
        return $RegisterController->comparetoken($token);
    }
    
    private function randomName($request)
    {
        //เปลี่ยนชื่อรูป
        return  rand(). '.' . $request->picture->extension(); 
    }

    private function getUser($userToken){
        //ดึงข้อมูลจาก DB ออกมาโดยใช้ token เทียบ
        $user = DB::table('users')->where('userToken',$userToken)->first();
        return $user;
    }

    private function pathFile($request)
    {
        
        $username = $this->getUser($request->input('userToken'));
        $path_image = "/images/vehicleprofile/".$username['userName'].'/';
        return $path_image;
    }

    private function updateImage($data)
    {
        $user_db = $this->getUser($data['userToken']);
        $action = $data['action'];
        $path_image = $data['path'];
        
        $data = [
            $action=>$path_image,
            'updateAt'=>date("Y-m-dTH:i:s\Z"),
        ];
        $this->removePicture($action,$user_db['_id']);
        $vehicles = DB::table('vehicles')->where('user_id',$user_db['_id'])->update($data);
        if($vehicles){
            return response()->json([
                'status'=>200,
                'msg'=>'Upload success-update',
 
            ]);
        }else{
            
            $data = [
                $action=>$path_image,
                'user_id'=>$user_db['_id'],
                'createAt'=>date("Y-m-dTH:i:s\Z"),
                
            ];
           
            $user1 = DB::table('vehicles')->insert($data);
            if($user1){
                return response()->json([
                    'status'=>200,
                    'msg'=>'Upload success-insert',
     
                ]); 
            }
        }
    }

    private function removePicture($action,$_id)
    {
        $vehicles = DB::table('vehicles')->where([['user_id',$_id],])->first();
        
        @unlink(public_path($vehicles[$action]));
    }
    private function multiupdateImage($data)
    {
        $user_db = $this->getUser($data['userToken']);
        
        $action = $data['action'];
        $path_image = $data['path'];
        $vehicles = DB::table('vehicles')->where('user_id',$user_db['_id'])->first();

        if($vehicles){
            $data_update = [];
            $user1 = DB::table('vehicles')
                            ->where([
                                ['user_id',$user_db['_id']],
                                
                            ])
                            ->push( 'vehicleDetailPicture',$path_image);
                            
            if($user1){
                return response()->json([
                    'status'=>200,
                    'msg'=>'Upload success multi-push',
     
                ]); 
            }
        }else{
            $path_image_arr = array($path_image);
            $data_insert = [
                $action=>$path_image_arr,
                'user_id'=>$user_db['_id'],
                'createAt'=>date("Y-m-dTH:i:s\Z"),
            ];
            
            $vehicles_insert = DB::table('vehicles')->insert($data_insert);
            if($vehicles_insert){
                return response()->json([
                    'status'=>200,
                    'msg'=>'Upload success multi-insert',
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

        $img = Image::make(public_path($path_image));
        $img->insert(public_path('images/watermark/watermark.png'), 'center');
        $img->save(public_path($path_image));
        
        $data_update = [
            'path'=>$path_image,
            'action'=>$data->input('action'),
            'userToken'=>$data->input('userToken')
        ];
        
        $action = $data->input('action');
        if($action=="vehicleDetailPicture"){
            return $this->multiupdateImage($data_update);
        } else {
             return $this->updateImage($data_update);
        }
    }

    public function uploadvehicleImage(Request $request)
    {
        $userToken = $request->input('userToken');
        if ($this->comparetoken($userToken) === false) {
            return response()->json([
                'status' => 404,
                'msg' => 'token is not found',
            ]);
            exit;
        }
        return $this->uploadImageCenter($request);
     }


     public function checkvehicleupload(Request $request)
     {
        $userToken = $request->input('userToken');
        if ($this->comparetoken($userToken) === false) {
            return response()->json([
                'status' => 404,
                'msg' => 'token is not found',
            ]);
            exit;
        }

        $usercheck = DB::table('users')->where('userToken',$userToken)->first();
        $vehicle_user = DB::table('vehicles')->where('user_id',$usercheck['_id'])->first();

        $vehiclePicture =  empty($vehicle_user['vehiclePicture']) ?null:$vehicle_user['vehiclePicture']; // ทำให้ค่าว่างเปลี่ยนเป็น null ถ้าเป็นจริง
        $personalCardPicture =  empty($vehicle_user['personalCardPicture']) ?null:$vehicle_user['personalCardPicture'];
        $driverLicensePicture =  empty($vehicle_user['driverLicensePicture']) ?null:$vehicle_user['driverLicensePicture'];
        $actPicture =  empty($vehicle_user['actPicture']) ?null:$vehicle_user['actPicture'];
        $registrationPicture =  empty($vehicle_user['registrationPicture']) ?null:$vehicle_user['registrationPicture'];
        $insurancePicture =  empty($vehicle_user['insurancePicture']) ?null:$vehicle_user['insurancePicture'];
        $vehicleDetailPicture =  empty($vehicle_user['vehicleDetailPicture']) ?null:$vehicle_user['vehicleDetailPicture'];
        
        if($vehiclePicture==null || $personalCardPicture==null || $driverLicensePicture==null || $actPicture==null || $registrationPicture==null
        || $insurancePicture==null || $vehicleDetailPicture==null){
            
            return response()->json([
                'status'=>500,
                'msg'=>'upload failed',
                
            ]);  
         }
        else{

            $data = [
                'status'=> "pending"
            ];
            $vehicles_status = DB::table('vehicles')->where('user_id',$usercheck['_id'])->update($data);

            if($vehicles_status){
                return response()->json([
                    
                    'status'=>200,
                    'msg'=>'Pending approval',
                  
                ]); 
            }

            
        }
        
    }

     
    
}