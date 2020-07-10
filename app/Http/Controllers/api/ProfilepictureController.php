<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image,Str,Storage;
use App\Http\Controllers\api\RegisterController;

class ProfilepictureController extends Controller
{
    
    private function comparetoken($token)
    {
        $RegisterController = new RegisterController();
        return $RegisterController->comparetoken($token);
    }
    
    
    public function uploadprofile(Request $request)
    {
        $userToken = $request->header('userToken');
        if ($this->comparetoken($userToken) === false) {
            return response()->json([
                'status' => 404,
                'msg' => 'token is not found',
                
            ]);
            exit;
        }
        
        $json = $request->json()->all();
        
        $action = $json['action'];
        $image_64 = $request->input('picture');
        
        
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',')+1); 

        $image = str_replace($replace, '', $image_64); 

        $image = str_replace(' ', '+', $image); 

        $imageName = Str::random(10).'.'.$extension;

        
        $path_folder = public_path("images/").$action."/";
       
        if (!file_exists( $path_folder))  
        { 
            mkdir($path_folder, 0777, true);//เช็คโฟลเดอร์ว่ามีไหมถ้าไม่มีให้สร้างใหม่
        } 
        
        $path = $path_folder.$imageName;
        $path_image = "/images/$action/$imageName";// แพทที่เก็บรูป

       

        $status_upload = '';
        if(file_put_contents($path ,base64_decode($image))){
            $img = Image::make(public_path($path_image));
            $img->insert(public_path('images/watermark/watermark.png'), 'center');
            $img->save(public_path($path_image));

            $data = [
                $action=>$path_image,
                'updateAt'=>date("Y-m-dTH:i:s\Z"),
            ];
          
            $user = DB::table('users')->where('userToken',$userToken)->first();
            @unlink(public_path( $user[$action]));
            
            $user_update = DB::table('users')->where('userToken',$user['userToken'])->update($data);
            
            if($user_update){
                return response()->json([
                    'status'=>200,
                    'msg'=>'Upload success-update',
                    'status_upload' => 'true'
     
                ]);
            }else {
                return response()->json([
                    'status'=>500,
                    'msg'=>'upload failed',
                    'status_upload' => 'false'
     
                ]);
            }
            

        }else{
            $status_upload = "Unable to save the file.";
        }

        // return response()->json([
        
        //     // 'images' =>$image_64,
        //     'action'=>$action,
        //     'path'=>$path_image,
        //     'extension'=> $extension,//นามสกุลไฟล์
        //     'imageName'=> $imageName,
        //     'status_upload'=> $status_upload
        // ]);
        
       
     }

    
}
