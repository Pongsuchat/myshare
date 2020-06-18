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
Route::POST('login', 'api\LoginController@login');
Route::POST('userpicture', 'api\PersonalpictureController@userpicture');
Route::POST('personalpicture', 'api\PersonalpictureController@personalpicture');
Route::GET('getUser', 'UserController@getUser');

Route::GET('test', function(){
    echo 'test api';
});

