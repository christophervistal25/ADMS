<?php

Route::get('/', function () {
    return view('welcome');
});


Route::redirect('login', '/patient/login', 301);
Route::get('sample', function () {
  $test = [
    'id' => 1,
    'title' => 'Sample',
    'start' => 'September 20, 2019',
  ];

  return $test;
});

Auth::routes();



Route::group(['prefix' => 'admin'] , function () {
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
  	Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
  	Route::get('login', 'Auth\AdminLoginController@login')->name('admin.auth.login');
  	Route::post('login', 'Auth\AdminLoginController@loginAdmin')->name('admin.auth.loginAdmin');
  	Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.auth.logout');

    Route::resource('doctor', 'Admin\DoctorController');
});


Route::group(['prefix' => 'patient'] , function () {
    Route::get('/', 'PatientController@index')->name('patient.dashboard');
    Route::get('dashboard', 'PatientController@index')->name('patient.dashboard');
    Route::post('logout', 'Auth\PatientLoginController@logout')->name('patient.auth.logout');
  	Route::get('login', 'Auth\PatientLoginController@login')->name('patient.auth.login');
  	Route::post('login', 'Auth\PatientLoginController@loginPatient')->name('patient.auth.loginPatient');

    Route::resource('appointment', 'Patient\AppointmentController');
});

