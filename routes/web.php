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

// Route::get('/', function () {
//     return view('login/loginblackoffice');
//     // return view('index');
// });
Route::get('/','LoginController@index');
 Route::post('/loginblackoffice/checklogin', 'LoginController@checklogin');
Route::group(['middleware' => ['CheckAuth']], function () {
    Route::get('dashboard','DashboardController@index');

    
   
    Route::post('/register', 'RegisterController@register');

    Route::post('createuseradmin','AdminviewController@createuseradmin');
    Route::GET('usersdetail','AdminviewController@usersdetail');
    Route::GET('waitingforapprove','AdminviewController@waitingforapprove');

    Route::match(['post','get'],'/updatestatus', 'VehiclesController@updatestatus');
    Route::match(['post','get'],'/getdetailuser', 'VehiclesController@getdetailuser');

    Route::get('/adminuser','AdminviewController@adminuser');
    Route::get('/narmoluser','AdminviewController@narmoluser');

    Route::get('/travelprice','Price\TravelpriceController@travelprice');
    Route::match(['post','get'],'/tripprice','Price\TravelpriceController@tripprice');


    Route::get('/loginblackoffice/successlogin', 'LoginController@successlogin');
    Route::match(['post','get'],'/logout', 'LoginController@logout');

});



// Route::get('ชื่อเส้นทาง','ชื่อcontroller@ชื่อfunction');
