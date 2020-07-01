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
            // dd($request->input());
            // die;
            // echo $password; die;
            $user = DB::table('users')->where('phoneNumber',$phone)->first();
            if($user){
                if(Hash::check($password, $user['password'])){
                    // $data = Users::all();
                    // dd($user);

                    $data = [
                        '_id'=>$user['_id'],
                        'username'=>$user['userName'],
                        'role'=>$user['role']
                    ];
                    session()->put('user', $data);
                    // dd($dasta);
                    // return view('index',['allusers'=>$data]);
                    // header( "dashboard" );
                    return redirect('dashboard');
                }else{
                    echo "password incorrent";
                }
            }
    }



    public function successlogin()
    {
        return view('index');
    }

    public function logout(Request $request)
    {
        // Auth::logout();
        $request->session()->flush();
        return redirect('/');
    }
}
