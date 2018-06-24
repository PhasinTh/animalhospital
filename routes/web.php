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

  Route::get('/', 'HomeController@index');

  Route::resource('drug','DrugController');
  Route::resource('charge','DrugController');

  Route::resource('veterinary','EmployeeController');
  Route::resource('service','EmployeeController');
  Route::resource('finance','EmployeeController');
  Route::resource('employee','EmployeeController');


  Route::resource('setting','SettingController');
  Route::resource('registation','RegisterController');
  Route::resource('pet','PetController');

  Route::resource('prescription','PrescriptionController');
  Route::resource('receipt','ReceiptController');
  Route::post('receipt/save','ReceiptController@save');

  Route::resource('diagnose','DiagnoseController');
  Route::resource('appointment','AppointmentController');
  // Route::get('appointment/{id}/print','AppointmentController@print');


  Route::resource('pettype','PettypeController');
  Route::get('dailychart','DaillyChart@index');
  Route::get('schedule','ScheduleController@index');

  Auth::routes();
