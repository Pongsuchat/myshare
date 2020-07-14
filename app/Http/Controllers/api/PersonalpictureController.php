<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image,Str,Storage;
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
      
        @unlink(public_path( $user_db[$action]));
        
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
       
       
        // $image_64 = $request->input('picture');
        
        
        // $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        // $replace = substr($image_64, 0, strpos($image_64, ',')+1); 

        // // find substring fro replace here eg: data:image/png;base64,

        // $image = str_replace($replace, '', $image_64); 

        // $image = str_replace(' ', '+', $image); 

        // $imageName = Str::random(10).'.'.$extension;

        
        // $path_folder = public_path("images/dd/");
       
        // if (!file_exists( $path_folder))  
        // { 
        //     mkdir($path_folder, 0777, true);
        // } 
        
        // // die;
        // $path = $path_folder.$imageName;
        // // $path_image = 'imagesz

        // $img = Image::make($path_folder);
        // $img->insert(public_path('images/watermark/watermark.png'), 'center');
        // $img->save($path_folder);

        // $status_upload = '';
        // if(file_put_contents($path ,base64_decode($image))){
        //     $status_upload = "Success!";
        // }else{
        //     $status_upload = "Unable to save the file.";
        // }
        // // ->move(public_path($path),$filename);

        // // move_uploaded_file(base64_decode($image),public_path('images/').$imageName);
        // // Storage::disk('images/64/')->put($imageName, base64_decode($image));
        // return response()->json([
        
        //     // 'images' =>$image_64,
        //     // 'decode'=>$image,
        //     'path'=>$path,
        //     'extension'=> $extension,
        //     'imageName'=> $imageName,
        //     'status_upload'=> $status_upload
        // ]);
        
        
        
        // die;
    
       
       
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

        $user = DB::table('users')->where('userToken',$userToken)->first();
        
        $status = [
            'images_status'=> "success",
            'updateAt'=>date("Y-m-dTH:i:s\Z"),
            
        ];
        $user_status = DB::table('users')->where('userToken',$userToken)->update($status);
       
        return response()->json([

            'status' => 200,
            'msg' => 'all upload success',
          
        ]); 
    }

    public function checkStatus(Request $request)
    {
        $userToken = $request->header('userToken');
        
        if ($this->comparetoken($userToken) === false) {
            return response()->json([
                'status' => 404,
                'msg' => 'token is not found',
            ]);
            exit;
        }
        
        $usert_status = DB::table('users')->where('userToken',$userToken)->first();
        $vehicles = DB::table('vehicles')->where('user_id',$usert_status['_id'])->get();
        
       if($usert_status['images_status']=='success'){

        return response()->json([
            'status' => 200,
            'ms.
            g' => 'true',
            'vehicleNumber' =>$vehicles->count(),
            'vehicledata' => $vehicles,
        ]);

       }elseif($usert_status['images_status']=='success'){

        return response()->json([
            'status' => 500,
            'msg' => 'failed',              
            'vehicleNumber' =>$vehicles->count(),
            'vehicledata' => $vehicles,
        ]);

       }

    }

 
}
