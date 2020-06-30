<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreatetripController extends Controller
{
    private function comparetoken($token)
    {
        $RegisterController = new RegisterController();
        return $RegisterController->comparetoken($token);
    }

    public function createtrip(Request $request)
    {
        $userToken = $request->header('userToken');
        if ($this->comparetoken($userToken) === false) {
            return response()->json([
                'status' => 404,
                'msg' => 'token is not found',
            ]);
            exit;
        }
        
        $user = DB::table('users')->where('userToken',$userToken)->first();
        $trip_create = DB::table('vehicles')->where('user_id',$usercheck['_id'])->first();
     }

}
