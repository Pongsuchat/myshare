<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use DB;

class RegisterController extends Controller
{ 
    function index()
    {
        //return view('upload');
    }
    
    public function register(Request $request)
    {
        
        $json=$request->json()->all();
        // return response()->json($request->input());
        // die;
        $userName = $json['userName'];
        $phoneNumber = $json['phoneNumber'];
        $countryCode = $json['countryCode'];
        $password = $json['password'];
        
        
        //$personalPicture = $jon['file('personalPicture')'];
        // $personalPicture = $json['personalPicture'];
        // $userToken = $json['userToken'];
        //$role = $json['role'];
        // $deviceToken = $json['deviceToken'];
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

       
        $data = [
            
            'userName'=>$json['userName'],
            'phoneNumber'=>$json['phoneNumber'],
             'countryCode'=>$json['countryCode'],
             'password'=>Hash::make($password)
    //         // 'path_image' =>
    //         //'role'=>$role
        ];
        $insert=DB::table('users')->insert($data);
        if($insert){
             return response()->json([
                'status'=>200,
                'msg'=>'เพิ่มข้อมูลสำเร็จ'
            ]);
        }

     }
}
