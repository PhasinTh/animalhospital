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

// api for temp
Route::get('gettemp/{uid}','Api\ApiTempController@getTemp');
Route::post('drugtemp','Api\ApiTempController@addTemp');
Route::get('clearTemp/{uid}','Api\ApiTempController@clearTemp');
Route::delete('deltemp/{id}','Api\ApiTempController@delTemp');

// api for drug
Route::get('getdrug','Api\ApiDrugController@getDrugs');
Route::get('getcharge','Api\ApiDrugController@getCharge');
Route::get('getdrug/{id}','Api\ApiDrugController@getDrug');

// api for registers
Route::get('getregister/{id}','Api\ApiController@getRegister');
Route::post('register','Api\ApiController@register');

// api for pet
Route::get('getPet','Api\ApiController@getPets');
Route::post('savepettype','Api\ApiController@savepettype');
Route::post('getpettype','Api\ApiController@getpettype');

// api utilities
Route::get('getinfo/{id}','Api\ApiController@getprescription');
Route::get('stats','Api\ApiController@getStats');
Route::get('getappointments','Api\ApiController@getAppointments');
Route::get('inroom','Api\ApiController@inroom');
