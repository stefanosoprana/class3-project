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
Route::get('/apartment/{id}', 'ApartmentController@show');
//tutte le altre rotte appartamenti
Route::middleware('auth')->group(function () {
    Route::get('/apartments/{user}', 'ApartmentController@userIndex')->name('apartments.user.index');
    Route::get('/apartment/{id}/statistics', 'ApartmentController@statistics')->name('apartment.statistics');
    Route::post('/apartment/create', 'ApartmentController@create')->name('apartment.create');
    Route::delete('/apartment/{id}/delete', 'ApartmentController@destroy')->name('apartment.destroy');
    Route::patch('/apartment/{id}/edit', 'ApartmentController@edit')->name('apartment.edit');
});


Auth::routes();

//controllo middleware in HomeController
Route::get('/home', 'HomeController@index')->name('profile');

Route::post('/message/create', 'MessageController@create')->name('message.create');

//rotte per messaggi
Route::middleware('auth')->group(function () {
    Route::get('/messages/{user}', 'MessageController@index')->name('messages.index');
    Route::delete('/messages/{id}/delete', 'MessageController@destroy')->name('messages.destroy');
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
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::delete('/user/{id}/delete', 'UserController@delete')->name('users.delete');
    Route::patch('/user/{id}/edit', 'UserController@edit')->name('users.edit');

    //appartamenti
    Route::get('/apartments', 'ApartmentController@index')->name('apartments.index');
    Route::get('/apartment/{id}/statistics', 'ApartmentController@statistics')->name('apartment.statistic');
    Route::delete('/apartment/{id}/delete', 'ApartmentController@destroy')->name('apartment.destroy');
    Route::patch('/apartment/{id}/edit', 'ApartmentController@edit')->name('apartment.edit');
    Route::get('/apartmens/sponsorships', 'ApartmentController@sponsorships')->name('apartments.sponsorships');
});

