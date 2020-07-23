<?php

namespace App\Http\Controllers\api\Createtrip;

use Carbon\Carbon;
use App\Http\Controllers\api\RegisterController;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Tripprice;
use DateTime;
use DateInterval;
// use MongoDB\BSON\UTCDateTime as MongoDate;


class CreatetripController extends Controller
{
    private function comparetoken($token)
    {
        $RegisterController = new RegisterController();
        return $RegisterController->comparetoken($token);
    }

    public function createTrip(Request $request)
    {

        $mytime = now();
 
        $pricerate_travel = DB::table('tripprice')->first();
        // return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
        //     // 'status' => 403,
        //     'status' => date('Y-m-dTH:i:s\Z'),
        //     'msg' => now(),
        // ]);
        
        
        // die;     
        
        $userToken = $request->header('userToken');
        if ($this->comparetoken($userToken) === false) {
            return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                'status' => 403,
                'msg' => 'token is not found',
            ]);
            exit;
             
        }
       
        $tripprice = Tripprice::get();
        $data = $tripprice->first();
        $pricerate = $data['travel']['priceRate'];


        $json = $request->json()->all();
        $tripFrom = $json['tripFrom'];
        $tripTo = $json['tripTo'];
        $stopPoint = $json['stopPoint'];
        $distance = $json['distance'];
        $departureDate = $json['departureDate'];
        $tripType = $json['tripType'];
        $supplieSize = $json['supplieSize'];
        $supplieQuantity = $json['supplieQuantity'];
        $supplieWeight = $json['supplieWeight'];
        $carId = $json['carId']; 
        $remark = $json['remark'];

        $user = DB::table('users')->where('userToken',$userToken)->first();
        $driverId = $user['_id'];
        $tripId =   $user['userName'].rand(); 

        
        $netPrice = $pricerate*$distance;
    //    $datetimestamp = (new DateTime())->add(new DateInterval('PT7H'));
       $datetimestamp = new DateTime();
       $datetime_insert = new \MongoDB\BSON\UTCDateTime($datetimestamp);

       $departureDate_stamp = new Datetime($departureDate);
       $departureDate_insert = new \MongoDB\BSON\UTCDateTime($departureDate_stamp);
       
   
        $trip_data = [
        
            'tripId' =>$tripId,
            'driverId' =>$driverId,
            'tripFrom' => $json['tripFrom'],
            'tripTo' => $json['tripTo'],
            'stopPoint' => $json['stopPoint'],
            'distance' => $json['distance'],
            'departureDate' => $departureDate_insert,
            'tripType' => $json['tripType'],
            'supplieSize' => $json['supplieSize'],
            'supplieQuantity' => $json['supplieQuantity'],
            'supplieWeight' => $json['supplieWeight'],
            'remark' => $json['remark'],
            'carId' =>$carId,
            'tripStatus' => 'pending',
            'timestamps' => $datetime_insert,
             'netPrice' =>$netPrice,
           
            
        ];
       

       $trip_insert = DB::table('tripprice_travel')->insert($trip_data);
        if ($trip_insert) {

            $trip_insert = DB::table('trip')->insert($trip_data);

            return response()->json([
                'status' => 200,
                'msg' => 'OK',
                
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'msg' => 'ข้อมูลการสร้าง trip ไม่ถูกต้อง ทำให้ไม่สามารถอนุมัติสร้างได้',

            ]);
        }
    }

    public function myTripsAll(Request $request)
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
        $driverId = $user['_id'];

        $mytrip_all = DB::table('trip')->where([
            ['driverId', '=', $driverId],
            
        ])
        ->whereIn('tripStatus', ['pending','traveling'],)->get();


        if ($mytrip_all->count()>0) {
           
            return response()->json([
                'status' => 200,
                'msg' => 'OK',
                'data' => $mytrip_all,
                
            ]);
        }else {
            return response()->json([
                'status' => 204,
                'msg' => 'ผู้ให้บริการยังไม่เคยสร้าง',
                
            ]);
        }

        
    }


    public function myTripswithBooked(Request $request)
    {
                  
        $userToken = $request->header('userToken');
        if ($this->comparetoken($userToken) === false) {
            return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                'status' => 403,
                'msg' => 'token is not found',
            ]);
            exit;
             
        }

                   
        $userToken = $request->header('userToken');
        if ($this->comparetoken($userToken) === false) {
            return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                'status' => 403,
                'msg' => 'token is not found',
            ]);
            exit;
             
        }

        $user = DB::table('users')->where('userToken',$userToken)->first();
        $driverId = $user['_id'];

        $myTripswithBooked = DB::table('trip')->where([
            ['driverId', '=', $driverId],
           
            
        ])->whereNotNull('tripMember')
        ->whereIn('tripStatus', ['pending','traveling'],)->get();


        if ($myTripswithBooked->count()>0) {

            return response()->json([
                'status' => 200,
                'msg' => 'OK',
                'data' => $myTripswithBooked,
                
            ]);
        }else {
            return response()->json([
                'status' => 204,
                'msg' => 'ยังไม่มี Trips ที่ผู้ให้บริการสร้างถูกจอง',
                
            ]);
        }
    }

    public function myTripsNext3Days(Request $request)
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
        $driverId = $user['_id'];

        $next3day = date("Y-m-dTH:i:s\Z",strtotime("+2 days"));
        $timenow = date("Y-m-dTH:i:s\Z");
    
        
        $myTripsNext3Days = DB::table('trip')->where([
            ['driverId', '=', $driverId],
            ['departureDate', '>=', $timenow],
            ['departureDate', '<=', $next3day]
          
        ])->get();
        
        if ($myTripsNext3Days->count()>0) {
            return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                'status' => 200,
                'msg' => 'OK',
                'data' => $myTripsNext3Days,
                
            ]);
        }else {
            return response()->json([                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   

                'status' => '204',
                'msg' => 'ผู้ให้บริการ ไม่มี Trips ที่ใกล้จะถึงภายใน 3 วัน',
            ]);
        }
    }
}
