<?php

Route::get('/', function () {
    return view('welcome');
});


Route::redirect('login', '/patient/login', 301);


Auth::routes();



Route::group(['prefix' => 'admin'] , function () {
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
  	Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
  	Route::get('login', 'Auth\AdminLoginController@login')->name('admin.auth.login');
  	Route::post('login', 'Auth\AdminLoginController@loginAdmin')->name('admin.auth.loginAdmin');
  	Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.auth.logout');

    Route::resource('doctor', 'Admin\DoctorController');
    Route::resource('service', 'Admin\ServiceController');
    Route::resource('doctorappointment', 'Admin\DoctorAppointmentController');
    
    Route::get('/patient/search/{name}', 'Admin\PatientController@searchPatient');
    Route::resource('patient', 'Admin\PatientController');

    Route::resource('close', 'Admin\CloseDaysController');
});


Route::group(['prefix' => 'patient'] , function () {
    Route::get('/', 'PatientController@index')->name('patient.dashboard');
    Route::get('dashboard', 'PatientController@index')->name('patient.dashboard');
    Route::post('logout', 'Auth\PatientLoginController@logout')->name('patient.auth.logout');
  	Route::get('login', 'Auth\PatientLoginController@login')->name('patient.auth.login');
  	Route::post('login', 'Auth\PatientLoginController@loginPatient')->name('patient.auth.loginPatient');
    
    Route::get('register', 'Auth\PatientRegisterController@register')->name('patient.auth.register');
    Route::post('register', 'Auth\PatientRegisterController@registerPatient')->name('patient.auth.registerPatient');

    Route::get('/appointment/available/{date}/{doctorId}/{serviceDuration}', 'Patient\AppointmentController@getAvailables');
    
    Route::get('/appointment/confirmation/{appointment}', 'Patient\AppointmentConfirmation@print');
    
    Route::resource('appointment', 'Patient\AppointmentController');

    Route::get('/edit', 'PatientController@edit')->name('account.settings');
    Route::put('/edit/{patient}', 'PatientController@update')->name('account.settings.update');

});

