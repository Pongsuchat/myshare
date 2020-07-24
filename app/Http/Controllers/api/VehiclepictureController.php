<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image,Str,Storage;
use App\Http\Controllers\api\RegisterController;
use DateTime;
use DateInterval;


class VehiclepictureController extends Controller
{
      
    private function comparetoken($token)
    {
        $RegisterController = new RegisterController();
        return $RegisterController->comparetoken($token);
    }
    
    
    public function uploadvehicleprofile(Request $request)
    {
        $userToken = $request->header('userToken');
        if ($this->comparetoken($userToken) === false) {
            return response()->json([
                'status' => 404,
                'msg' => 'token is not found',
                
            ]);
            exit;
        }
        
        $user = DB::table('users')->where('userToken',$userToken)->first(); //ค้านหา username จากtoken
        $user_name =$user['userName'];
        $user_id =$user['_id'];

        $json = $request->json()->all();
        $action = $json['action'];
        $image_64 = $request->input('picture');

       
        
        
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];
        $replace = substr($image_64, 0, strpos($image_64, ',')+1); 

        $image = str_replace($replace, '', $image_64); 

        $image = str_replace(' ', '+', $image); 

        $imageName = Str::random(10).'.'.$extension;

        
        $path_folder = public_path("images/vehicleprofile/").$user_name."/";

       
        if (!file_exists( $path_folder))  
        { 
            mkdir($path_folder, 0777, true);//เช็คโฟลเดอร์ว่ามีไหมถ้าไม่มีให้สร้างใหม่
        } 
        
        $path = $path_folder.$imageName;
        $path_image = "/images/vehicleprofile/$user_name/$imageName";// แพทที่เก็บรูป

         $multipicture = [
            'path_image'=>$path_image,
            'path'=>$path,
            'action'=>$action,
            'userToken'=> $userToken,
            'picture' => $image
        ];

        
        if($action=="vehicleDetailPicture"){
            //เช็คว่าเป็นการอัพโหลดหลายรูปไหมถ้าใ่ช่ให้โยนไป functino multiupdateImage
            return $this->multiupdateImage($multipicture);
        } 
       
        // $status_upload = '';
        if(file_put_contents($path ,base64_decode($image))){
            $img = Image::make(public_path($path_image));
            $img->insert(public_path('images/watermark/watermark.png'), 'center');
            $img->save(public_path($path_image));

            $updateAt = new DateTime();
            $updateAt_insert = new \MongoDB\BSON\UTCDateTime($updateAt);
            $createAt = new DateTime();
            $createAt_insert = new \MongoDB\BSON\UTCDateTime($createAt);

            $data = [
                $action=>$path_image,
                'updateAt'=> $updateAt_insert,
            ];
          
            $vehicles_fineuser = DB::table('vehicles')->where([['user_id',$user_id],])->first();
        
            @unlink(public_path($vehicles_fineuser[$action]));
            
           
            $vehicles = DB::table('vehicles')->where('user_id',$user_id)->update($data);

           
        if($vehicles){
            return response()->json([
                'status'=>200,
                'msg'=>'Upload success-update',
 
            ]);
        }else{
            
            $data = [
                $action=>$path_image,
                'user_id'=>$user_id,
                'status'=> "waiting",
                'image_status'=> "waiting",
                'createAt'=> $createAt_insert,
                
            ];
           
            $vehicle_create = DB::table('vehicles')->insert($data);
            if($vehicle_create){
                return response()->json([
                    'status'=>200,
                    'msg'=>'Upload success-insert',
     
                ]); 
            }
            else {
                return response()->json([
                    'status'=>500,
                    'msg'=>'upload failed',
     
                ]);
            }
        }
            
        }else{
            $status_upload = "Unable to save the file.";
        }
       
     }

     private function multiupdateImage($multipicture)
    {
        $updateAt = new DateTime();
        $updateAt_insert = new \MongoDB\BSON\UTCDateTime($updateAt);
        $createAt = new DateTime();
        $createAt_insert = new \MongoDB\BSON\UTCDateTime($createAt);
      
        $user = DB::table('users')->where('userToken',$multipicture['userToken'])->first(); //ค้านหา username จากtoken
        $user_name =$user['userName'];
        $user_id =$user['_id'];
        $action = $multipicture['action'];
        $path_image = $multipicture['path_image'];
        $image = $multipicture['picture'];
        $path = $multipicture['path'];

         if(file_put_contents($path ,base64_decode($image))){
            $img = Image::make(public_path($path_image));
            $img->insert(public_path('images/watermark/watermark.png'), 'center');
            $img->save(public_path($path_image));

            $data = [
                $action=>$path_image,
                'updateAt'=> $updateAt,
            ];

        $vehicles_fineuser = DB::table('vehicles')->where([['user_id',$user_id]])->first();
        
        if($vehicles_fineuser){
            $multipicture = [
                'updateAt'=> $updateAt,
            ];
            
            $vehicles_multipicture = DB::table('vehicles')
                            ->where([
                                ['user_id',$user_id],
                                
                            ])
                            ->push( 'vehicleDetailPicture',$path_image);
                            
            $vehicles = DB::table('vehicles')->where('user_id',$user_id)->update($multipicture);                
                            
            if($vehicles_multipicture){
                return response()->json([
                    'status'=>200,
                    'msg'=>'Upload success multi-push',
     
                ]); 
            }else {
                return response()->json([
                    'status'=>500,
                    'msg'=>'upload failed',
     
                ]);}
            
        }else{
            $path_image_arr = array($path_image);
            $data_insert = [
                $action=>$path_image_arr,
                'user_id'=>$user_id,
                'status'=> "waiting",
                'image_status'=> "waiting",
                'createAt'=> $createAt_insert,
            ];
            
            $vehicles_insert = DB::table('vehicles')->insert($data_insert);
            if($vehicles_insert){
                return response()->json([
                    'status'=>200,
                    'msg'=>'Upload success multi-insert',
                ]); 
            }
            else {
                return response()->json([
                    'status'=>500,
                    'msg'=>'upload failed',
     
                ]);
            }
        }
    }
}

}
