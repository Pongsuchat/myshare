<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
use App\Http\Controllers\api\RegisterController;

class PersonalpictureController extends Controller
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
        
        $profile = $request->input('action');
        $username = $this->getUser($request->header('userToken'));
        $path_image = "/images/".$profile.'/';
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
        // $this->removePicture($action,$user_db['userToken']);
        @unlink(public_path( $user_db['userPicture']));
        
        $user_update = DB::table('users')->where('userToken',$user_db['userToken'])->update($data);
        
        if($user_update){
            return response()->json([
                'status'=>200,
                'msg'=>'Upload success-update',
 
            ]);
        }else {
            return response()->json([
                'status'=>500,
                'msg'=>'upload failed',
 
            ]);
        }
    }

    // private function removePicture($action,$userToken)
    // {
        
       
    //     $user_re = DB::table('users')->where([['userToken',$userToken],])->first();
    //     return $user_re;
    //     die;
        
    //     @unlink(public_path($user_re[$action]));
    // }

    
    private function userImageCenter($data)
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
            'userToken'=>$data->header('userToken')
        ];
        
        $action = $data->input('action');
        
             return $this->updateImage($data_update);
        
    }

    public function uploaduserImage(Request $request)
    {
        $userToken = $request->header('userToken');
        if ($this->comparetoken($userToken) === false) {
            return response()->json([
                'status' => 404,
                'msg' => 'token is not found',
            ]);
            exit;
        }
        return $this->userImageCenter($request);
     }

    public function checkupload(Request $request)
    
    {
        $userToken = $request->header('userToken');
        
        if ($this->comparetoken($userToken) === false) {
            return response()->json([
                'status' => 404,
                'msg' => 'token is not found',
            ]);
            exit;
        }
        return response()->json([
                    
            'status'=>200,
            'msg'=>'all upload success',
          
        ]); 
    }
}
