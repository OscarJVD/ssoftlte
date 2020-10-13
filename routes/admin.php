<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/

// Route::get('movie', ['as'=> 'movie.index', 'uses' => 'MovieController@index']);

Route::resource('movie', 'MovieController');
Route::get('movie/destroy/{id}', ['as' => 'movie/destroy', 'uses' => 'MovieController@destroy']);
Route::post('movie/show', ['as' => 'movie/show', 'uses' => 'MovieController@show']);
Route::put('movie/update/{id}', ['as' => 'movie.update ', 'uses' => 'MovieController@update']);

Route::resource('rental', 'RentalController');
Route::get('rental/destroy/{id}', ['as' => 'rental/destroy', 'uses' => 'RentalController@destroy']);
Route::post('rental/show', ['as' => 'rental/show', 'uses' => 'RentalController@show']);
Route::post('rental/update/{id}', ['as' => 'rental/update', 'uses' => 'RentalController@update']);

Route::resource('role', 'RoleController');
Route::get('role/destroy/{id}', ['as' => 'role/destroy', 'uses' => 'RoleController@destroy']);
Route::post('role/show', ['as' => 'role/show', 'uses' => 'RoleController@show']);
Route::post('role/update/{id}', ['as' => 'role/update', 'uses' => 'RoleController@update']);

Route::resource('user', 'UserController');
Route::get('user/destroy/{id}', ['as' => 'user/destroy', 'uses' => 'UserController@destroy']);
Route::post('user/show', ['as' => 'user/show', 'uses' => 'UserController@show']);
Route::post('user/update/{id}', ['as' => 'user/update', 'uses' => 'UserController@update']);

Route::post('user/updateStatus/{id}', ['as' => 'user/updateStatus', 'uses' => 'UserController@updateStatus']);

Route::get('users/export/', 'UserController@export');
Route::post('users/import', 'UserController@import')->name('users.import.excel');

Route::get('users/pdf', 'UserController@pdf')->name('users.pdf');

Route::resource('status', 'StatusController');
Route::get('status/destroy/{id}', ['as' => 'status/destroy', 'uses' => 'StatusController@destroy']);
Route::post('status/show', ['as' => 'status/show', 'uses' => 'StatusController@show']);
Route::post('status/update/{id}', ['as' => 'status/update', 'uses' => 'StatusController@update']);

Route::resource('type_status', 'TypeStatusController');
Route::get('type_status/destroy/{id}', ['as' => 'type_status/destroy', 'uses' => 'TypeStatusController@destroy']);
Route::post('type_status/show', ['as' => 'type_status/show', 'uses' => 'TypeStatusController@show']);
Route::post('type_status/update/{id}', ['as' => 'type_status/update', 'uses' => 'TypeStatusController@update']);

Route::resource('category', 'CategoryController');
Route::get('category/destroy/{id}', ['as' => 'category/destroy', 'uses' => 'CategoryController@destroy']);
Route::post('category/show', ['as' => 'category/show', 'uses' => 'CategoryController@show']);
Route::post('category/update/{id}', ['as' => 'category/update', 'uses' => 'CategoryController@update']);
