<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

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
                // $new_name = rand() . '.' . $uPicture->getClientOriginalExtension();
                $new_name =  rand() . '.' .$request->uPicture->extension();
                // $path_image = "/images/user/".$user['userName']."/".$new_name;
                //  $uPicture->move("images/user/".$user['userName'].'/', $new_name);
                $path_image = "/images/user/".$new_name;
                 $uPicture->move("images/user/", $new_name);

                 $update=DB::table('users')->where('userToken',$userToken)->update([
                        'userPicture'=>$path_image 
                        ]);
                        if($update){
                            return response()->json([
                               'status'=>200,
                               'msg'=>'Upload success'   
                           ]);
                        }
                //return response()->json( $path = $request->userPicture->path());  'url'=>$request->server ("SERVER_NAME")
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
                $perPicture = $request->file('perPicture');
                $new_name =  rand() . '.' .$request->perPicture->extension();
                $path_image = "/images/personal/".$new_name;
                $perPicture->move("images/personal/", $new_name);

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
        # code...
    }
}
