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

Route::post('/upload', 'UploadController@upload');

Route::get('/delivery', 'DeliveryController@index');
//Route::get('/send/goods', 'SendController@goods');
//Route::get('/send/leader', 'SendController@leader');
