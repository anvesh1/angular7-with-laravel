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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('register','ApiController@registerUser')->middleware(['cors']);
Route::options('register','ApiController@register')->middleware(['cors']);

Route::post('login','ApiController@login')->middleware(['cors']);
Route::options('login','ApiController@login')->middleware(['cors']);


Route::group(['middleware' => ['cors','jwt.auth']], function () {

    Route::options('change-password', 'ApiController@changeUserPassword');
	Route::post('change-password', 'ApiController@changeUserPassword');

    Route::options('update-user-info', 'ApiController@updateUserInfo');
	Route::post('update-user-info', 'ApiController@updateUserInfo');

	Route::options('get-user-list', 'ApiController@getUserList');
	Route::post('get-user-list', 'ApiController@getUserList');

	Route::options('get-user-details', 'ApiController@getUserDetails');
	Route::post('get-user-details', 'ApiController@getUserDetails');

	Route::options('user-activation','ApiController@userActivation');
	Route::post('user-activation','ApiController@userActivation');

	Route::options('delete-user','ApiController@deleteUser');
	Route::post('delete-user','ApiController@deleteUser');

	Route::post('logout','ApiController@userLogout')->middleware(['cors']);
	Route::options('logout','ApiController@userLogout')->middleware(['cors']);

});



