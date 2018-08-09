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

Route::middleware('cors','auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', 'AuthController@register')->middleware('cors');
Route::post('login', 'AuthController@login')->middleware('cors');
Route::post('recover', 'AuthController@recover')->middleware('cors');

Route::group(['middleware' => ['cors','jwt.auth']], function() {
    Route::get('logout', 'AuthController@logout');
});


Route::post('/github/email', 'ApiController@store')->middleware('jwt.auth');

Route::get('send_test_email', function(){
	Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
	{
		$message->to('johndoe@gmail.com');
	});
});