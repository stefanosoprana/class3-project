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
    Route::get('/apartment/{id}/dashboard', 'ApartmentController@show')->name('apartment.dashboard');
});
