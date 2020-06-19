<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use DB;
use File;
use Hash;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;

class LoginController extends Controller
{
    
    public function token_jwt()
    {
        $payload = array(
            "iss" => "myshare",
            "aud" => "myshare",
            "iat" => date("now"), //เวลาเริ่มต้น
            "exp" => time() + 60,
        );
        $privatekey = File::get(storage_path() . '\key\private.key'); //ไปอ่านไฟล์key
        $jwt = JWT::encode($payload, $privatekey, 'RS256');
        return $jwt;

    }

    public function login(Request $request)
    {

        $json = $request->json()->all();
        $phoneNumber = $json['phoneNumber'];
        $password = $json['password'];
        $deviceToken = $json['deviceToken'];
        $token = $this->token_jwt();

        $data = [
            //เก็บรูปแบบข้อมูลที่รับมาเป็น array
            'deviceToken' => $deviceToken,
            'userToken' => $token,
        ];

        $user = DB::table('users')->where('phoneNumber', $phoneNumber)->first();

        if ($user) {
            if (Hash::check($password, $user['password'])) {

                $update = DB::table('users')->where('phoneNumber', $phoneNumber)->update([
                    'userToken' => $token, 'deviceToken' => $deviceToken,
                ]);

                return response()->json([
                    'status' => 200,
                    'msg' => 'success',
                    'usertoken' => $token, //$new_user['userToken'] //ส่งโทเคนไปหลังจากสมัครเสร็จ 'ชื่อที่สื่อกับหน้าบ้าน' => ตัวแปลที่ประกาศตอนจะquery->ชื่อฟีิล
                ]);

            } else {
                return response()->json([
                    'status' => 500,
                    'msg' => 'The phone number or password is incorrect',

                ]);
            }
        } else {
            return response()->json([
                'status' => 404,
                'msg' => 'The phone number or password is incorrect',

            ]);
        }
    }

}
