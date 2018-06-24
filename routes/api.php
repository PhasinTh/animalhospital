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

Route::get('getdrug','Api\ApiController@getDrugs');
Route::get('getcharge','Api\ApiController@getCharge');
Route::get('getdrug/{id}','Api\ApiController@getDrug');

Route::get('clearTemp','Api\ApiController@clearTemp');
Route::post('drugtemp','Api\ApiController@addTemp');
Route::get('gettemp','Api\ApiController@getTemp');
Route::delete('deltemp/{id}','Api\ApiController@delTemp');

Route::get('getPet','Api\ApiController@getPets');
Route::get('getinfo/{id}','Api\ApiController@getprescription');
Route::get('stats','Api\ApiController@getStats');
Route::get('getappointments','Api\ApiController@getAppointments');

Route::post('savepettype','Api\ApiController@savepettype');
Route::post('getpettype','Api\ApiController@getpettype');

Route::get('getregister/{id}','Api\ApiController@getRegister');
Route::get('inroom','Api\ApiController@inroom');

Route::post('register','Api\ApiController@register');
