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
    public function register(Request $request)
    {
        $json=$request->json()->all();
        $userName = $json['userName'];
        $phoneNumber = $json['phoneNumber'];
        $password = $json['password'];
        $deviceToken = $json['deviceToken'];
        $token = $this->token_jwt();

        // dd($token);
        $data = [
            
            'userName'=>$json['userName'],
            'phoneNumber'=>$json['phoneNumber'],
             'password'=>Hash::make($password),
             'deviceToken'=>$deviceToken, 
             'userToken'=> $token,
             'created'=>date("Y-m-d H:i:s"),
            
        ];
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
