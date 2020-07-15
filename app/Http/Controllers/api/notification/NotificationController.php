<?php

namespace App\Http\Controllers\api\notification;

use App\Http\Controllers\api\RegisterController;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    private function comparetoken($token)
    {
        $RegisterController = new RegisterController();
        return $RegisterController->comparetoken($token);
    }

    public function myNotificationList(Request $request)
    {
        $userToken = $request->header('userToken');
        if ($this->comparetoken($userToken) === false) {
            return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                'status' => 403,
                'msg' => 'token is not found',
            ]);
            exit;
        }

        $user = DB::table('users')->where('userToken',$userToken)->first();
        $recipientId = $user['_id'];

        $notification_all = DB::table('notification')->where('recipientId',$recipientId)->get();
        

        $notification_data ='';//ประกาศเป็น gobal
        foreach ($notification_all as $key => $value) {
            
                $notification_data = $value;
            
        }

        $data = [
                'header' => $notification_data['header'],
                'message' => $notification_data['message'],
                'data' => $notification_data['data'],
                'timestamp' => $notification_data['timestamp'],
            ];
        

       if ($notification_all) {
        return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
            'status' => 200,
            'msg' => 'OK',
            'data' => $data
        ]);
        
       }else {
        return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
            'status' => 204,
            'msg' => 'ยังไม่มีการแจ้งเตือน',
            'data' => $data
        ]);
       }
    }
}
