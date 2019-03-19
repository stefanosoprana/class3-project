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


//guest
Route::get('/', function () {
    return view('public.home');
});

//tutti gli appartamenti con ricerca per guest
Route::get('/apartments', 'ApartmentController@index');
Route::get('/apartment/{id}', 'ApartmentController@show')->middleware('visit');
//tutte le altre rotte appartamenti
Route::middleware('auth')->group(function () {
    Route::get('/apartments/{user}', 'ApartmentController@userIndex')->name('apartments.user.index');
    Route::get('/apartment', 'ApartmentController@create')->name('apartment.create');
    Route::post('/apartment', 'ApartmentController@store')->name('apartment.store');
    Route::patch('/apartment/{id}/update', 'ApartmentController@update')->name('apartment.update');
    Route::get('/apartment/{id}/statistics', 'ApartmentController@statistics')->name('apartment.statistic');
    Route::delete('/apartment/{id}/delete', 'ApartmentController@destroy')->name('apartment.destroy');
});


Auth::routes();

//controllo middleware in HomeController
Route::get('/home', 'HomeController@index')->name('profile');

Route::get('/message', 'MessageController@create')->name('message.create');
Route::post('/message', 'MessageController@store')->name('message.storep');

//rotte per messaggi
Route::middleware('auth')->group(function () {
    Route::get('/messages/{user}', 'MessageController@index')->name('messages.index');
    Route::get('/message/{id}', 'MessageController@show')->name('message.show');
    Route::delete('/message/{id}/delete', 'MessageController@destroy')->name('message.destroy');
});

//rotte per sponsorships
Route::middleware('auth')->group(function () {
    Route::get('/apartment/{id}/sponsorship', 'SponsorshipController@index')->name('sponsorships.index');
    Route::post('/apartment/{id}/sponsorship', 'SponsorshipController@payment')->name('sponsorships.payment');
});

//rotte per Admin
Route::middleware('permission:Admin')->namespace('Admin')->prefix('Admin')->name('Admin.')->group(function () {
    Route::get('/home', 'HomeController@index')->name('index');

    //utenti
    Route::resource('users', 'UserController');

    //appartamenti
    Route::get('/apartments', 'ApartmentController@index')->name('apartments.index');
    Route::get('/apartment/{id}', 'ApartmentController@show')->name('apartment.show');
    Route::get('/apartment', 'ApartmentController@create')->name('apartment.create');
    Route::post('/apartment', 'ApartmentController@store')->name('apartment.store');
    Route::patch('/apartment/{id}/update', 'ApartmentController@update')->name('apartment.update');
    Route::get('/apartment/{id}/statistics', 'ApartmentController@statistics')->name('apartment.statistic');
    Route::delete('/apartment/{id}/delete', 'ApartmentController@destroy')->name('apartment.destroy');
    Route::get('/apartmens/sponsorships', 'ApartmentController@sponsorships')->name('apartments.sponsorships');
});

