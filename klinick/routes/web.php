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
    'as' => 'user.login_get',
    'uses' => 'Controller@userLogin'
]);

/** Rota POST onde são enviado os dados de login fornecidos*/
Route::post('/login',[
    'as' => 'user.login_post',
    'uses' => 'Controller@login'
]);

Route::get('/logout', [
    'as' => 'user.logout',
    'uses' => 'Controller@logout'
]);

Route::get('/register',[
    'as' => 'user.register_get',
    'uses' => 'UsersController@register'
]);

Route::get('/user/settings/personal_data',[
    'as' => 'user.settingsPersonalData',
    'uses' => 'UsersController@settingsPersonalData'
]);

Route::get('/user/settings/auth_data',[
    'as' => 'user.settingsAuthData',
    'uses' => 'UsersController@settingsAuthData'
]);

Route::put('/user/updating/personal_data',[
    'as' => 'user.updatingPersonalData',
    'uses' => 'UsersController@updatePersonalData'
]);

Route::put('/user/updating/auth_data',[
    'as' => 'user.updatingAuthData',
    'uses' => 'UsersController@updatingAuthData'
]);

Route::resource('user', 'UsersController');


