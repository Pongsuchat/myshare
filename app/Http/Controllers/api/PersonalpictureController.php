<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class PersonalpictureController extends Controller
{

    


    function userpicture(Request $request)
    {
        $uPicture = $request->file('uPicture');
        $userToken = $request->input('userToken');

        $user = DB::table('users')->where('userToken',$userToken)->first();

        if($user){
            if($userToken == $user['userToken']){
                @unlink(public_path( $user['userPicture']));//unlink เลือกไฟล์ที่อยู่ในก้อนข้อข้อมูล$user ที่ฟิล userPicture ทำให้ลบข้อมูลเดิมก่อนที่จะอัพข้อมูลใหม่เข้าไป
                $uPicture = $request->file('uPicture');
                
                $new_name =  rand() . '.' .$request->uPicture->extension();
               
                $path_image = "/images/user/".$new_name;
                 $uPicture->move("images/user/", $new_name);

                 $img = Image::make(public_path($path_image));
                 $img->insert(public_path('images/watermark/watermark.png'), 'center');
                 $img->save(public_path($path_image));

                 $update=DB::table('users')->where('userToken',$userToken)->update([
                        'userPicture'=>$path_image 
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

    public function personalpicture(Request $request)
    {

        $perPicture = $request->file('perPicture');
        $userToken = $request->input('userToken');
        
        $user = DB::table('users')->where('userToken',$userToken)->first();

        if($user){
            if($userToken == $user['userToken']){
                @unlink(public_path( $user['personalPicture']));//unlink เลือกไฟล์ที่อยู่ในก้อนข้อข้อมูล$user ที่ฟิล userPicture ทำให้ลบข้อมูลเดิมก่อนที่จะอัพข้อมูลใหม่เข้าไป
                $perPicture = $request->file('perPicture');//รับไฟล์มาจากหน้าบ้าน
                $new_name =  rand() . '.' .$request->perPicture->extension();//เปลี่ยนชื่อ
                $path_image = "/images/personal/".$new_name;//กำหนดพาท
                $perPicture->move("images/personal/", $new_name);//ย้ายรูปไปยังพาท

                $img = Image::make(public_path($path_image));
                $img->insert(public_path('images/watermark/watermark.png'), 'center');
                $img->save(public_path($path_image));

                 $update=DB::table('users')->where('userToken',$userToken)->update([
                        'personalPicture'=>$path_image 
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

    public function checkupload(Request $request)
    {
        $userToken = $request->input('userToken');
        $user = DB::table('users')->where('userToken',$userToken)->first();
        $userPicture =  empty($user['userPicture']) ?null:$user['userPicture']; // ทำให้ค่าว่างเปลี่ยนเป็น null ถ้าเป็นจริง
        $personalPicture = empty($user['personalPicture']) ?null:$user['personalPicture'];


        if($userPicture==null || $personalPicture==null){
            
            return response()->json([
                'status'=>404,
                'msg'=>'picture not found',
                
            ]);  
         }
        else{
            return response()->json([
                'status'=>200,
                'msg'=>'all upload success',
            ]);
        }
        
    }

    
}
