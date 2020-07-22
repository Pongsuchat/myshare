<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//('ชื่อเส้นทาง','ชื่อcontroller@function')
// Route::POST('register', 'RegisterController@register');

Route::POST('register', 'api\RegisterController@register');
Route::Post('comparetoken','api\RegisterController@comparetoken');

Route::POST('login', 'api\LoginController@login');

Route::POST('uploaduserImage', 'api\PersonalpictureController@uploaduserImage');
 Route::GET('checkStatus', 'api\PersonalpictureController@checkStatus');
Route::POST('checkupload', 'api\PersonalpictureController@checkupload');

Route::POST('uploadprofile', 'api\ProfilepictureController@uploadprofile');

Route::POST('checkvehicleupload', 'api\VehicleconfirmController@checkvehicleupload');
Route::POST('uploadvehicleImage', 'api\VehicleconfirmController@uploadvehicleImage');
Route::POST('multiuploadvehicleImage', 'api\VehicleconfirmController@multiuploadvehicleImage');

Route::POST('uploadvehicleprofile', 'api\VehiclepictureController@uploadvehicleprofile');

Route::POST('createTrip', 'api\Createtrip\CreatetripController@createTrip');

Route::GET('myNotificationList', 'api\notification\NotificationController@myNotificationList');

Route::POST('createtrip', 'api\Createtrip\CreatetripController@createtrip');
Route::GET('myTripsAll', 'api\Createtrip\CreatetripController@myTripsAll');
Route::GET('myTripswithBooked', 'api\Createtrip\CreatetripController@myTripswithBooked');
Route::GET('myTripsNext3Days', 'api\Createtrip\CreatetripController@myTripsNext3Days');

Route::GET('myVehicle', 'api\Createtrip\VehicledetailController@myVehicle');
Route::GET('myDetailVehicle', 'api\Createtrip\VehicledetailController@myDetailVehicle');
Route::POST('editMyDetailVehicle', 'api\Createtrip\VehicledetailController@editMyDetailVehicle');
Route::POST('createVehicle', 'api\Createtrip\VehicledetailController@createVehicle');




Route::GET('getUser', 'UserController@getUser');

Route::GET('test', function(){
    echo 'test api';
});

