<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use DB;
use \Firebase\JWT\JWT;
use File;
use App\Http\Controllers\RegisterController;


class LoginController extends Controller
{
    // private function token_jwt()
    // {
    //     $RegisterController = new RegisterController();
    //     $token_jwt = $RegisterController->token_jwt();
    //     return $token_jwt;

    // }
    public function checkdevictoken($phoneNumber)
    {
        $user = DB::table('users')->where('phoneNumber', $phoneNumber)->first();

        // return response()->json($user);
        if($user){
            return true;
        }else{
            return false;
        }
        
    }

    public function login(Request $request)
    {
        $json=$request->json()->all();
        $phoneNumber = $json['phoneNumber'];
        $password = $json['password'];
        $deviceToken = $json['deviceToken'];
        // $token = $this->token_jwt();

        $data = [
            //เก็บรูปแบบข้อมูลที่รับมาเป็น array
             'deviceToken'=>$deviceToken, 
        ];

        $user = DB::table('users')->where('phoneNumber',$phoneNumber)->first();
        // $insert=DB::table('users')->insert($data);
        // return $user->phoneNumber;
        // die;
        if($user){
            if(Hash::check($password, $user['password'])){
                
                return response()->json([
                    'status'=>200,
                    'msg'=>'success',
                    'data'=>$user //ส่งโทเคนไปหลังจากสมัครเสร็จ 'ชื่อที่สื่อกับหน้าบ้าน' => ตัวแปลที่ประกาศตอนจะquery->ชื่อฟีิล
                ]);
                    
            }else{
                return response()->json([
                    'status'=>500,
                    'msg'=>'The phone number or password is incorrect',
                    
                ]);
            }
        }else{
            return response()->json([
                'status'=>404,
                'msg'=>'The phone number or password is incorrect',
                
            ]);
        }
    }

   
}
