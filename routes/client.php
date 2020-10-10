<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Client" middleware group. Now create something great!
|
*/

// Route::get('movie', ['as'=> 'movie.index', 'uses' => 'MovieController@index']);


Route::resource('movie', 'MovieController');
Route::get('movie/destroy/{id}', ['as'=> 'movie/destroy', 'uses' => 'MovieController@destroy']);
Route::post('movie/show', ['as' => 'movie/show', 'uses' => 'MovieController@show']);
Route::post('movie/update/{id}', ['as' => 'movie/update', 'uses' => 'MovieController@update']);

Route::resource('rental', 'RentalController');
Route::get('rental/destroy/{id}', ['as'=> 'rental/destroy', 'uses' => 'RentalController@destroy']);
Route::post('rental/show', ['as' => 'rental/show', 'uses' => 'RentalController@show']);
Route::post('rental/update/{id}', ['as' => 'rental/update', 'uses' => 'RentalController@update']);