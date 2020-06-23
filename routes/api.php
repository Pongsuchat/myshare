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

Route::POST('userpicture', 'api\PersonalpictureController@userpicture');//route รูปประจำตัว
Route::POST('personalpicture', 'api\PersonalpictureController@personalpicture');//route รูปบัตรประชาชน
Route::POST('vehicleprofileconfirm', 'api\VehicleconfirmController@vehicleprofileconfirm');
Route::POST('uploadvehicleImage', 'api\VehicleconfirmController@uploadvehicleImage');
Route::POST('multiuploadvehicleImage', 'api\VehicleconfirmController@multiuploadvehicleImage');
Route::POST('imageWatermark', 'api\PersonalpictureController@imageWatermark');



Route::GET('getUser', 'UserController@getUser');

Route::GET('test', function(){
    echo 'test api';
});

