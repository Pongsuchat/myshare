<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use DB;
use \Firebase\JWT\JWT;
use File;

class RegisterController extends Controller
{
    public function token_jwt()
    {
        $payload = array(
            "iss" => "http://192.168.253.144:8000",
            "aud" => "http://192.168.253.144:8000",
            // "iat" =>  date("now"),//เวลาเริ่มต้น
            // "exp" => -//เวลาหมดอายุ
        );
        $privatekey = File::get(storage_path() . '\key\private.key');//ไปอ่านไฟล์key
        $jwt = JWT::encode($payload, $privatekey, 'RS256');
        // $publicKey = File::get(storage_path() . '\key\public.key');
        // $decoded = JWT::decode($jwt, $publicKey, array('RS256'));
        return $jwt;

    }

    public function comparetoken($token)
    {
        $user = DB::table('users')->where('userToken', $token)->first();

        if($user){
            // return response()->json([
            //     'status'=>200,
            //     'msg'=>'token success'
            // ]);
            return true;
        }else{
            // return response()->json([
            //     'status'=>404,
            //     'msg'=>'token is not found'
            // ]);
            return false;
     

        }

        // $user = DB::table('users')->where('userToken',$userToken)->first();
        // if($userToken == $user['userToken']){
        //     @unlink(public_path( $user['personalPicture']));//unlink เลือกไฟล์ที่อยู่ในก้อนข้อข้อมูล$user ที่ฟิล userPicture ทำให้ลบข้อมูลเดิมก่อนที่จะอัพข้อมูลใหม่เข้าไป
        //     $perPicture = $request->file('perPicture');
        //     $new_name =  rand() . '.' .$request->perPicture->extension();
        //     $path_image = "/images/personal/".$new_name;
        //     $perPicture->move("images/personal/", $new_name);

        //      $update=DB::table('users')->where('userToken',$userToken)->update([
        //             'personalPicture'=>$path_image 
        //             ]);
        //             if($update){
        //                 return response()->json([
        //                    'status'=>200,
        //                    'msg'=>'Upload success'   
        //                ]);
        //             }
        // }else{
        //     return response()->json([
        //         'status'=>500,
        //         'msg'=>'Upload Failed',
        //     ]);
        // }
    
    }

    public function checkusername($userName)
    {
        $user = DB::table('users')->where('userName', $userName)->first();

        if($user){
            return true;
        }else{
            return false;
        }
        
    }

    public function checkphonenumber($phoneNumber)
    {
        $user = DB::table('users')->where('phoneNumber', $phoneNumber)->first();

        if($user){
            return true;
        }else{
            return false;
        }
        
    }

    public function register(Request $request)
    {
        //รับข้อมูลรูปแบบ json มา
        $json=$request->json()->all();
        $userName = $json['userName'];
        $phoneNumber = $json['phoneNumber'];
        $password = $json['password'];
        $deviceToken = $json['deviceToken'];
        $token = $this->token_jwt();

        
        $data = [
            //เก็บรูปแบบข้อมูลที่รับมาเป็น array
            'userName'=>$json['userName'],
            'phoneNumber'=>$json['phoneNumber'],
             'password'=>Hash::make($password),
             'deviceToken'=>$deviceToken, 
             'userToken'=> $token,
             'created'=>date("Y-m-d H:i:s")
            
        ];
       
        if($this->checkphonenumber($phoneNumber)===true){
            return response()->json([
                'status'=>500,
                'msg'=>'Phone number has already been used.'
            ]);
            exit;
        }elseif($this->checkusername($userName)===true){
            return response()->json([
                    'status'=>500,
                    'msg'=>'Username has already been used.'
                ]);
                exit;
         }

        $insert=DB::table('users')->insert($data);
        if($insert){
             return response()->json([
                'status'=>200,
                'msg'=>'success',
                'userToken'=>$token //ส่งโทเคนไปหลังจากสมัครเสร็จ
            ]);
        }else {
            return response()->json([
                'status'=>500,
                'msg'=>'Can not register please try again'
                
            ]);
        }

     }
}
