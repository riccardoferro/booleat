<?php

use Illuminate\Support\Facades\Route;



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



Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('index');

        // Route::get('/', 'HomeController@index')
        //     ->name('index');
        Route::resource('/user', 'UserController');
        Route::resource('/plates', 'PlatesController');
        Route::resource('/categories', 'CategoriesController');
        Route::resource('/order', 'OrdersController');
    });

Route::get('/', function () {
    return view('guest.home');
});



//tutte le rotte non autenticate, quindi gli utenti non registrati
// verranno mandati qui
Route::get("{any?}", function () {

    // Lavorazioni in corso
    return view('layouts.notFound');
})->where("any", ".*");
