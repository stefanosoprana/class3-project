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



//tutti gli appartamenti con ricerca per guest
    Route::get('/', 'ApartmentController@index')->name('apartments.index');
    Route::get('/apartments', 'ApartmentController@search')->name('apartments.search');
    Route::get('/apartment/{id}', 'ApartmentController@show')->middleware('visit')->name('apartment.show');
    Route::post('/apartment/message', 'MessageController@store')->name('apartment.message.store');


//tutte le altre rotte appartamenti
Route::middleware('auth')->group(function () {
    Route::get('/apartments/{user}', 'ApartmentController@userIndex')->name('apartments.user.index');
    Route::get('/apartment', 'ApartmentController@create')->name('apartment.create');
    Route::post('/apartment', 'ApartmentController@store')->name('apartment.store');
    Route::get('/apartment/{id}/edit', 'ApartmentController@edit')->name('apartment.edit');
    Route::patch('/apartment/{id}', 'ApartmentController@update')->name('apartment.update');
    Route::get('/apartment/{apartment}/statistics', 'ApartmentController@statistics')->name('apartment.statistic');
    Route::delete('/apartment/{id}/delete', 'ApartmentController@destroy')->name('apartment.destroy');
});


Auth::routes();

//controllo middleware in HomeController
Route::get('/home', 'HomeController@index')->name('profile');

Route::get('/message', 'MessageController@create')->name('message.create');
Route::post('/message', 'MessageController@store')->name('message.store');

//rotte per messaggi
Route::middleware('auth')->group(function () {
    Route::get('{user}/messages', 'MessageController@index')->name('messages.index');
    Route::get('/message/{id}', 'MessageController@show')->name('message.show');
    Route::delete('/message/{id}/delete', 'MessageController@destroy')->name('message.destroy');
});

//rotte per sponsorships
Route::middleware('auth')->group(function () {
    Route::get('/apartment/{id}/sponsorship', 'SponsorshipController@index')->name('sponsorships.index');
    Route::get('/apartment/{id}/sponsorship/{sponsorship_type_id}/pay', 'SponsorshipController@payment')->name('sponsorships.payment');
    Route::post('/apartment/{id}/sponsorship/process', 'SponsorshipController@process')->name('sponsorships.process');
});

//rotte per Admin
Route::middleware('permission:modify')->namespace('Admin')->prefix('Admin')->name('Admin.')->group(function () {
   // Route::get('/home', 'HomeController@index')->name('index');

    // messaggi
    Route::get('/messages/admin', 'MessageController@index')->name('messages.index');
    Route::get('/messages/{id}/admin', 'MessageController@show')->name('messages.show');

    //utenti
    Route::resource('users', 'UserController');

    //appartamenti
    Route::get('/apartments', 'ApartmentController@index')->name('apartments.index');
    Route::get('/apartment/{id}', 'ApartmentController@show')->name('apartment.show');
    Route::get('/apartment', 'ApartmentController@create')->name('apartment.create');
    Route::get('/apartment/{id}/edit', 'ApartmentController@edit')->name('apartment.edit');
    Route::post('/apartment', 'ApartmentController@store')->name('apartment.store');
    Route::patch('/apartment/{id}/update', 'ApartmentController@update')->name('apartment.update');
    Route::get('/apartment/{id}/statistics', 'ApartmentController@statistics')->name('apartment.statistic');
    Route::delete('/apartment/{id}/delete', 'ApartmentController@destroy')->name('apartment.destroy');
    Route::get('/apartmens/sponsorships', 'ApartmentController@sponsorships')->name('apartments.sponsorships');

});
