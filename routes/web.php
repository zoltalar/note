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

Route::get('/', 'AppController@index');

Route::group(['prefix' => 'categories'], function() {
    Route::get('index', 'CategoriesController@index');
});

Route::group(['prefix' => 'notes'], function() {
    Route::get('index', 'NotesController@index');
    Route::post('store', 'NotesController@store');
    Route::get('destroy/{id}', 'NotesController@destroy');
    Route::get('order', 'NotesController@order');
});