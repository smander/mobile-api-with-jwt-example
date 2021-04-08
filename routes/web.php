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

Auth::routes();


Route::prefix('users')->group(function () {

    Route::get('/update/{id}',[
        'as' => 'users.update',
        'uses' => 'UserController@update'
    ]);

    Route::post('/update',[
        'as' => 'users.updateProfile',
        'uses' => 'UserController@updateProfile'
    ]);
});




Route::get('/home', 'UserController@index')->name('home');
