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
Route::get('song/{slug}','SongController@show');
Route::post('song','SongController@store');
Route::put('song/{slug}','SongController@update');
Route::delete('song/{slug}','SongController@destroy');

//Route Categories
Route::get('category','CategoryController@index');
Route::get('category/{slug}','CategoryController@show');
Route::post('category','CategoryController@store');
Route::put('category/{slug}','CategoryController@update');
Route::delete('category/{slug}','CategoryController@destroy');

//Route Thread
Route::get('thread','ThreadController@index');
Route::get('thread/{slug}','ThreadController@show');
Route::post('thread','ThreadController@store');
Route::put('thread/{slug}','ThreadController@update');
Route::delete('thread/{slug}','ThreadController@destroy');

//Route Thread
Route::get('genre','GenreController@index');
Route::get('genre/{name}','GenreController@show');
Route::post('genre','GenreController@store');
Route::put('genre/{name}','GenreController@update');
Route::delete('genre/{name}','GenreController@destroy');