<?php

use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     return view('welcome');
// });
//
// Route::get('/test', function () {
//     return 'test';
// });


// crud作る場合は以下
Route::resource('trips', 'TripController');

// 検索
Route::post('/trips/search', 'TripController@search')->name('search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
