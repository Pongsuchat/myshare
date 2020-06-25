<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use DB;
use File;
use Hash;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;

class RegisterController extends Controller
{
    public function token_jwt()
    {
        $payload = array(
            "iss" => rand(),
            "aud" => rand(),
            "iat" => date("now"), //เวลาเริ่มต้น
            "exp" => time() + 60,
        
        );
        $privatekey = File::get(storage_path() . '/key/private.key'); //ไปอ่านไฟล์key
        $jwt = JWT::encode($payload, $privatekey, 'RS256');
        // $publicKey = File::get(storage_path() . '\key\public.key');
        // $decoded = JWT::decode($jwt, $publicKey, array('RS256'));
        return $jwt;

    }

    public function comparetoken($token)
    {
        $user = DB::table('users')->where('userToken', $token)->first();

        if ($user) {

            return true;
        } else {

            return false;

        }

    }

    public function checkusername($userName)
    {
        $user = DB::table('users')->where('userName', $userName)->first();

        if ($user) {
            return true;
        } else {
            return false;
        }

    }

    public function checkphonenumber($phoneNumber)
    {
        $user = DB::table('users')->where('phoneNumber', $phoneNumber)->first();

        if ($user) {
            return true;
        } else {
            return false;
        }

    }

    public function register(Request $request)
    {
        $json = $request->json()->all();
        $userName = $json['userName'];
        $phoneNumber = $json['phoneNumber'];
        $password = $json['password'];
        $deviceToken = $json['deviceToken'];
        $token = $this->token_jwt();
        

        $data = [
        
            'userName' => $json['userName'],
            'phoneNumber' => $json['phoneNumber'],
            'password' => Hash::make($password),
            'deviceToken' => $deviceToken,
            'userToken' => $token,
            'role' => "Normal User",
            'status' => "New user",
            'created' => date("Y-m-dTH:i:s\Z"),
        
        ];

        if($userName==null || $phoneNumber==null || $password==null || $deviceToken==null ){

            return response()->json([
                'status'=>500,
                'msg'=>'some input is null',
                
            ]);exit; 
        }


        if ($this->checkphonenumber($phoneNumber) === true) {
            return response()->json([
                'status' => 500,
                'msg' => 'Phone number has already been used.',

            ]);
            exit;
        } elseif ($this->checkusername($userName) === true) {
            return response()->json([
                'status' => 500,
                'msg' => 'Username has already been used.',
            ]);
            exit;
        }

        $insert = DB::table('users')->insert($data);
        if ($insert) {
            return response()->json([
                'status' => 200,
                'msg' => 'success',
                'userToken' => $token,
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'msg' => 'Can not register please try again',

            ]);
        }

    }

}
