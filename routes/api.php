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

Route::group(['middleware' => ['cors']], function() {
    Route::post('register', 'AuthController@register')->middleware('cors');
    Route::post('login', 'AuthController@login')->middleware('cors');
    Route::post('recover', 'AuthController@recover')->middleware('cors');
});

//MetaData Routes
Route::prefix('users')->group(function () {

    Route::post('create', 'AuthController@register');
    Route::post('update/{id}', 'AuthController@update');
    Route::get('/', 'AuthController@');
});

Route::group(['middleware' => ['cors','jwt.auth']], function() {
    Route::get('logout', 'AuthController@logout');
});
