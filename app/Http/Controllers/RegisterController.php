<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use DB;

class RegisterController extends Controller
{ public function register(Request $request)
    {
        $json=$request->json()->all();
        $userName = $json['userName'];
        $phoneNumber = $json['phoneNumber'];
        $countryCode = $json['countryCode'];
        $password = $json['password'];
        // $personalPicture = $json['personalPicture'];
        // $userToken = $json['userToken'];
         $role = $json['role'];
        // $deviceToken = $json['deviceToken'];

        
        $data = [
            
            'userName'=>$userName,
            'phoneNumber'=>$phoneNumber,
            'countryCode'=>$countryCode,
            'password'=>Hash::make($password),
            'role'=>$role
        ];
        $insert=DB::table('users')->insert($data);
        if($insert){
             return response()->json([
                'status'=>200,
                'msg'=>'เพิ่มข้อมูลสำเร็จ'
            ]);
        }
       
        // echo "hello mama";
    }
}
