<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login/loginblackoffice');
    // return view('index');
});
Route::get('dashboard','DashboardController@index');
Route::get('loginblackoffice','LoginController@index');
Route::post('/loginblackoffice/checklogin', 'LoginController@checklogin');
Route::post('/register', 'RegisterController@register');
Route::resource('users','CreateuserController');
Route::post('/updatestatus', 'VehiclesController@updatestatus');

    Route::get('/test', function () {
        echo "ssss";
    });
    Route::get('/loginblackoffice/successlogin', 'LoginController@successlogin');
    Route::match(['post','get'],'/logout', 'LoginController@logout');


// Route::get('ชื่อเส้นทาง','ชื่อcontroller@ชื่อfunction');
