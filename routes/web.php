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

  // route for Employee
  Route::resource('veterinary','EmployeeController');
  Route::resource('service','EmployeeController');
  Route::resource('finance','EmployeeController');
  Route::resource('employee','EmployeeController');

  //route for drug
  Route::resource('drug','DrugController');
  Route::resource('charge','DrugController');

  // route for pet and owner
  Route::resource('pet','PetController');
  Route::resource('pettype','PettypeController');

  // route for registration
  Route::resource('registation','RegisterController');

  // route for prescription
  Route::resource('prescription','PrescriptionController');

  // route for recript
  Route::resource('receipt','ReceiptController');
  Route::post('receipt/save','ReceiptController@save');


  //route for Dianose and appointment
  Route::resource('appointment','AppointmentController');
  Route::resource('diagnose','DiagnoseController');

  // route for utilties
  Route::resource('setting','SettingController');
  Route::get('dailychart','DaillyChart@index');
  Route::get('schedule','ScheduleController@index');




  Auth::routes();
