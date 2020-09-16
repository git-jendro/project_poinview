<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

//Route Albums
Route::get('album','AlbumController@index');
Route::get('album/{id}','AlbumController@show');
Route::post('album','AlbumController@store');
Route::put('album/{id}','AlbumController@update');
Route::delete('album/{id}','AlbumController@destroy');

//Route Songs
Route::get('song','SongController@index');
Route::get('song/{id}','SongController@show');
Route::post('song','SongController@store');
Route::put('song/{id}','SongController@update');
Route::delete('song/{id}','SongController@destroy');

//Route Categories
Route::get('category','CategoryController@index');
Route::get('category/{id}','CategoryController@show');
Route::post('category','CategoryController@store');
Route::put('category/{id}','CategoryController@update');
Route::delete('category/{id}','CategoryController@destroy');

//Route Thread
Route::get('thread','ThreadController@index');
Route::get('thread/{slug}','ThreadController@show');
Route::post('thread','ThreadController@store');
Route::put('thread/{slug}','ThreadController@update');
Route::delete('thread/{slug}','ThreadController@destroy');