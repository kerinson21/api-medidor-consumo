<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login', 'LoginController@authenticate');

// rutas para las mediciones
Route::get('/electricitymeter', 'ElectricityMeterController@index');
Route::post('/electricitymeter/save', 'ElectricityMeterController@store');


// rutas para los dispositivos
Route::get('/device', 'DeviceController@index');
Route::post('/device/store', 'DeviceController@store');
Route::put('/device/update', 'DeviceController@update');

//rutas para lecturas
Route::get('/reading', 'ReadingController@index');
Route::post('/reading/store', 'ReadingController@store');

//calculos de consumo
Route::get('/reading/month','ReadingController@monthly');
Route::get('/reading/year', 'ReadingController@year');
Route::get('/reading/day', 'ReadingController@day');

//rutas para el usuario
Route::get('/user', 'UserController@index');
Route::post('/user/create', 'UserController@create');

//asignaciones de usuarios a dispositivos
Route::get('/assigned', 'AssignedController@index');
Route::get('/assgined/reading', 'AssignedController@readingDevice');


