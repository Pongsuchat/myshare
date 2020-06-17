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
Route::POST('register', 'RegisterController@register');

Route::GET('getUser', 'UserController@getUser');

Route::GET('test', function(){
    echo 'test api';
});

Route::group([

    
    'prefix' => 'auth'

], function () {

    Route::post('login', 'api\AuthController@login');
    Route::post('logout', 'api\AuthController@logout');
    Route::post('refresh', 'api\AuthController@refresh');
    Route::post('me', 'api\AuthController@me');

});