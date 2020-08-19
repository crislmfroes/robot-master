<?php

use Illuminate\Support\Facades\Route;

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
/*
Route::get('/robot/create', 'RobotController@create')->name('create_robot')->middleware('auth');
Route::post('/robot/store', 'RobotController@store')->name('store_robot')->middleware('auth');
Route::post('/robot/update/{robot}', 'RobotController@update')->name('update_robot')->middleware('auth');
Route::get('/robot/index', 'RobotController@index')->name('list_robots')->middleware('auth');
Route::get('/robot/delete/{robot}', 'RobotController@destroy')->name('destroy_robot')->middleware('auth');
Route::get('/robot/edit/{robot}', 'RobotController@edit')->name('edit_robot')->middleware('auth');

Route::get('/robot/{robot}/behavior/index', 'BehaviorController@index')->name('list_behaviors')->middleware('auth');
Route::get('/robot/{robot}/behavior/create', 'BehaviorController@create')->name('create_behavior')->middleware('auth');
Route::get('/robot/{robot}/behavior/edit/{behavior}', 'BehaviorController@edit')->name('edit_behavior')->middleware('auth');
Route::get('/robot/{robot}/behavior/destroy/{behavior}', 'BehaviorController@destroy')->name('destroy_behavior')->middleware('auth');
Route::post('/robot/{robot}/behavior/store', 'BehaviorController@store')->name('store_behavior')->middleware('auth');
Route::post('/robot/{robot}/behavior/update/{behavior}', 'BehaviorController@update')->name('update_behavior')->middleware('auth');

Route::get('/robot/{robot}/state/index', 'StateController@index')->name('list_states')->middleware('auth');
Route::get('/robot/{robot}/state/create', 'StateController@create')->name('create_state')->middleware('auth');
Route::get('/robot/{robot}/state/edit/{state}', 'StateController@edit')->name('edit_state')->middleware('auth');
Route::get('/robot/{robot}/state/destroy/{state}', 'StateController@destroy')->name('destroy_state')->middleware('auth');
Route::post('/robot/{robot}/state/store', 'StateController@store')->name('store_state')->middleware('auth');
Route::post('/robot/{robot}/state/update/{state}', 'StateController@update')->name('update_state')->middleware('auth');
*/

Route::middleware('auth')->resource('robots', 'RobotController');
Route::middleware('auth')->resource('behaviors', 'BehaviorController');
Route::middleware('auth')->resource('states', 'StateController');
