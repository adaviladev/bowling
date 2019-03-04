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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'api'], function () {
    Route::resource('users', 'UsersController');
    Route::resource('games', 'GamesController');
    Route::resource('games/{game}/rolls', 'RollsController');
});

Route::get('{spa?}', function () {
    return view('welcome');
})->where('catchall', '^(?!api).*$')->name('vue');
