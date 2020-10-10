<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Employee Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Employee" middleware group. Now create something great!
|
*/


Route::resource('movie', 'MovieController');
Route::get('movie/destroy/{id}', ['as'=> 'movie/destroy', 'uses' => 'MovieController@destroy']);
Route::post('movie/show', ['as' => 'movie/show', 'uses' => 'MovieController@show']);
Route::post('movie/update/{id}', ['as' => 'movie/update', 'uses' => 'MovieController@update']);

Route::resource('rental', 'RentalController');
Route::get('rental/destroy/{id}', ['as'=> 'rental/destroy', 'uses' => 'RentalController@destroy']);
Route::post('rental/show', ['as' => 'rental/show', 'uses' => 'RentalController@show']);
Route::post('rental/update/{id}', ['as' => 'rental/update', 'uses' => 'RentalController@update']);

Route::resource('user', 'UserController');
Route::get('user/destroy/{id}', ['as'=> 'user/destroy', 'uses' => 'UserController@destroy']);
Route::post('user/show', ['as' => 'user/show', 'uses' => 'UserController@show']);
Route::post('user/update/{id}', ['as' => 'user/update', 'uses' => 'UserController@update']);