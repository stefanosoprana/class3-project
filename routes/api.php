<?php

use Illuminate\Http\Request;

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

Route::middleware('api.auth')->namespace('Api')->prefix('v1')->name('api.')->group(function() {
    Route::get('/messages', 'MessageController@index')->name('message.index');
    Route::get('/message/{id}', 'MessageController@show')->name('message.show');
    Route::get('/message', 'MessageController@create')->name('message.create');
    Route::post('/message', 'MessageController@store')->name('message.store');
    Route::post('/apartments', 'ApartmentController@search')->name('apartment.search');
    Route::get('/apartment/{id}/visits/{year}', 'ApartmentController@visits')->name('apartment.visits');
    Route::get('/apartment/{id}/messages/{year}', 'ApartmentController@messages')->name('apartment.messages');
});
