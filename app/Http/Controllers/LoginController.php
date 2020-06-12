<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use DB, Hash;
use App\Users;

class LoginController extends Controller
{
    public function index()
    {
        return view('login/loginblackoffice');
    }

    public function checklogin(Request $request)
    {
        $this->validate($request, [
            'phoneNumber' => 'required',
            'password' => 'required'
        ]);
            $phone=$request->phoneNumber;
            $password = $request->input('password');
            
            // echo $password; die;
            $user = DB::table('users')->where('phoneNumber',$phone)->first();
            if($user){
                if(Hash::check($password, $user['password'])){
                    $data = Users::all();
                    return view('index',['allusers'=>$data]);

                }else{
                    echo "password incorrent";
                }
            }
    }



    public function successlogin()
    {
        return view('index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
