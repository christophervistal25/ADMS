<?php
Route::get('/', 'HomeController@index');

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

    Route::get('/patient/examination/record/{patient}', 'Admin\PatientExaminationRecordController@create')
          ->name('patient.examination.record.create');

    Route::post('/patient/examination/record/{patient}', 'Admin\PatientExaminationRecordController@store')
          ->name('patient.examination.record.store');

    Route::get('/patient/examination/history/{patient}', 'Admin\PatientExaminationRecordController@history')
          ->name('patient.examination.history');

    Route::get('/patient/examination/{patient}', 'Admin\PatientExaminationRecordController@show')
          ->name('patient.examination.show');

    Route::get('/patient/examination/edit/{patient}', 'Admin\PatientExaminationRecordController@edit')
          ->name('patient.examination.edit');

    Route::put('/patient/examination/edit/{patient}', 'Admin\PatientExaminationRecordController@update')
          ->name('patient.examination.update');

    Route::get('/examination/{id}/{noOfTooth}/{service_rendered}/payment', 'Admin\ExaminationPaymentController@edit');
    Route::put('/examination/{id}/payment', 'Admin\ExaminationPaymentController@update');

    Route::get('/patient/examination/history/print/{ids}', 'Admin\ExaminationHistoryPrintController@print');

    Route::resource('close', 'Admin\CloseDaysController');

    Route::get('/account/setting', 'AdminController@edit')->name('admin.account.setting');
    Route::put('/account/setting/{admin}', 'AdminController@update')->name('admin.update.account.setting');
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

