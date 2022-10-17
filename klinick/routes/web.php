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
    return view('welcome');
});

/* Rota inicial */
Route::get('/login', [
	'as'	=> 'user.login_get',
	'uses'	=> 'Controller@userLogin'
]);

/** Rota POST onde são enviado os dados de login fornecidos*/
Route::post('/login',[
	'as'	=> 'user.login_post',
	'uses'	=> 'Controller@login'
]);

Route::get('/logout', [
	'as'	=> 'user.logout',
	'uses'	=> 'Controller@logout'
	]);

Route::get('/deactivated', [
	'as'	=> 'user.deactivated',
	'uses'	=> 'Controller@deactivated'
	]);

Route::get('/register', [
	'as'	=> 'user.register_get',
	'uses'	=> 'UsersController@register']);



Route::get('/user/settings/personal_data', [
	'as'	=> 'user.settingsPersonalData',
	'uses'	=> 'UsersController@settingsPersonalData']);

Route::get('/user/settings/auth_data', [
	'as'	=> 'user.settingsAuthData',
	'uses'	=> 'UsersController@settingsAuthData'
]);

Route::put('/user/updating/personal_data',[
	'as' 	=> 'user.updatingPersonalData',
	'uses' 	=> 'UsersController@updatingPersonalData'
]);

Route::put('/user/updating/auth_data',[
	'as'	=> 'user.updatingAuthData',
	'uses'	=> 'UsersController@updatingAuthData'
]);

Route::get('/user/settings/delete',[
	'as'	=> 'user.settingsDelete',
	'uses'	=> 'UsersController@settingsDelete'
]);

Route::delete('/user/delete',[
	'as'	=> 'user.delete',
	'uses'	=> 'UsersController@deleteUser'
]);

Route::resource('user', 'UsersController');


Route::resource('user/{user}/appointment', 'AppointmentsController');
Route::resource('user/{user}/medform', 'MedFormsController');



/*Route::get('/user/{user}/appointment/new',[
	'as'	=> 'user.appointment.new',
	'uses'	=> 'UsersController@newAppointment'
]);*/





Route::get('/doctor/agreement',[
	'as'	=> 'doctor.agreement',
	'uses'	=> 'DoctorsController@agreement'
]);

Route::get('/doctor/settings',[
	'as'	=> 'doctor.settings',
	'uses'	=> 'DoctorsController@settings'
]);

Route::get('/doctor/settings/delete',[
	'as'	=> 'doctor.delete',
	'uses'	=> 'DoctorsController@settingsDelete'
]);

Route::delete('/doctor/delete',[
	'as'	=> 'doctor.delete',
	'uses'	=> 'DoctorsController@deleteDoctor'
]);

Route::resource('doctor', 'DoctorsController');


