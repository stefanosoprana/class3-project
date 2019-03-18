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

Route::middleware('auth:api')->namespace('API')->namespace('API')->prefix('API')->name('API.')->group(function() {
    Route::get('/message/{id}', 'MessageController@show')->name('message.show');
    Route::post('/message/create', 'MessageController@create')->name('message.create');
    Route::post('/apartments/dashboard', 'ApartmentController@create')->name('apartment.dashboard');
});
