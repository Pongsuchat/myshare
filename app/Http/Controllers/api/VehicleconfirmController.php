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
        $RegisterController = new RegisterController();
        return $RegisterController->comparetoken($token);
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
    }

    private function updateImage($data)
    {
        $user_db = $this->getUser($data['userToken']);
        $action = $data['action'];
        $path_image = $data['path'];
        
        $data = [
            $action=>$path_image,
            'updateAt'=>date("Y-m-d H:i:s"),
        ];
        $this->removePicture($action,$user_db['_id']);
        $vehicles = DB::table('vehicles')->where('user_id',$user_db['_id'])->first();
        if($vehicles){
            return response()->json([
                'status'=>200,
                'msg'=>'Upload success-update',
 
            ]);
        }else{
            
            $data = [
                $action=>$path_image,
                'user_id'=>$user_db['_id'],
                'createAt'=>date("Y-m-d H:i:s"),
                'approveDate'=> "pending"
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
                'createAt'=>date("Y-m-d H:i:s"),
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
    
}