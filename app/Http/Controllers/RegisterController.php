<?php

namespace App\Http\Controllers;

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
                'userToken'=>$token
            ]);
        }

     }
}



        //$personalPicture = $jon['file('personalPicture')'];
        // $personalPicture = $json['personalPicture'];
        // $userToken = $json['userToken'];
        //$role = $json['role'];
        // $personalPicture = $json['personalPicture'];
        // $file = $_FILES[$personalPicture]['name'];
        // return response()->json($file);
        // $this->validate($request,
        // ['personalPicture' => 'required|image'],
        // ['personalPicture' => 'mimes:jpg,png,gif|max:2048']);
        // $personalPicture = $request->file('personalPicture');
        // $new_name = rand() . '.' . $personalPicture->getClientOriginalExtension();
        //  $personalPicture->move(public_path("images/$phoneNumber"), $new_name);
        //  $path_image=public_path("images/$phoneNumber").$new_name;
        //  return response()->json([
        //      'path'=>$path_image
        //  ]);
        //return back()->with('success', 'อัพโหลดไฟล์เรียบร้อยแล้ว')->with('path', $new_name);