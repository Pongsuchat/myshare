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
            "iss" => "name",
            "aud" => "name",
            // "iat" =>  date("now"),//เวลาเริ่มต้น
            // "exp" => -//เวลาหมดอายุ
        );
        $privatekey = File::get(storage_path() . '\key\private.key');//ไปอ่านไฟล์key
        $jwt = JWT::encode($payload, $privatekey, 'RS256');
        // $publicKey = File::get(storage_path() . '\key\public.key');
        // $decoded = JWT::decode($jwt, $publicKey, array('RS256'));
        return $jwt;

    }

    // public function checkusername($userName)
    // {
    //     $user = DB::table('users')->where('userName', $userName)->first();

    //     // return response()->json($user);
    //     if($user){
    //         return true;
    //     }else{
    //         return false;
    //     }
        
    // }

    public function checkphonenumber($phoneNumber)
    {
        $user = DB::table('users')->where('phoneNumber', $phoneNumber)->first();

        // return response()->json($user);
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

        // dd($token);
        $data = [
            //เก็บรูปแบบข้อมูลที่รับมาเป็น array
            'userName'=>$json['userName'],
            'phoneNumber'=>$json['phoneNumber'],
             'password'=>Hash::make($password),
             'deviceToken'=>$deviceToken, 
             'userToken'=> $token,
             'created'=>date("Y-m-d H:i:s"),
            
        ];
       
        if($this->checkphonenumber($phoneNumber)===true){
            return response()->json([
                'status'=>500,
                'msg'=>'Phone number has already been used.'
            ]);
            exit;
        // }elseif($this->checkusername($userName)===true){
        //     return response()->json([
        //             'status'=>500,
        //             'msg'=>'Username has already been used.'
        //         ]);
        //         exit;
         }

    
        $insert=DB::table('users')->insert($data);
        if($insert){
             return response()->json([
                'status'=>200,
                'msg'=>'success',
                //'userToken'=>$token ส่งโทเคนไปหลังจากสมัครเสร็จ
            ]);
        }

     }
}
