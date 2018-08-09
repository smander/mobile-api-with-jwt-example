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


Route::get('/home', 'HomeController@index')->name('home');

## Projects Routes

Route::get('/project/list', 'ProjectController@index')->name('project/list');
Route::get('/project/create', 'ProjectController@create')->name('project/create');
Route::post('/project/store', 'ProjectController@store');

## Adwords Routes

Route::get('/adwords/list', 'AdwordsPanelController@index')->name('adwords/list');
Route::get('/adwords/create', 'AdwordsPanelController@create')->name('adwords/create');
Route::post('/project/store', 'ProjectController@store');

## Settings Routes

Route::get('/settings/list', 'SettingsPanelController@index')->name('settings/list');