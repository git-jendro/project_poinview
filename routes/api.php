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
Route::get('albums','AlbumController@index');
Route::get('albums/{id}','AlbumController@show');
Route::post('albums','AlbumController@store');
Route::put('albums/{id}','AlbumController@update');
Route::delete('albums/{id}','AlbumController@destroy');

//Route Songs
Route::get('songs','SongController@index');
Route::get('songs/{id}','SongController@show');
Route::post('songs','SongController@store');
Route::put('songs/{id}','SongController@update');
Route::delete('songs/{id}','SongController@destroy');

//Route Categories
Route::get('categories','CategoryController@index');
Route::get('categories/{id}','CategoryController@show');
Route::post('categories','CategoryController@store');
Route::put('categories/{id}','CategoryController@update');
Route::delete('categories/{id}','CategoryController@destroy');

//Route Thread
Route::get('threads','ThreadController@index');
Route::get('threads/{id}','ThreadController@show');
Route::post('threads','ThreadController@store');
Route::put('threads/{id}','ThreadController@update');
Route::delete('threads/{id}','ThreadController@destroy');