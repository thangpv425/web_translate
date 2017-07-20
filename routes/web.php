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

/**
 * Route register
 */
Route::get('register', 'RegisterController@register');
Route::post('register', 'RegisterController@postRegister')->name('register');

/**
 * Route login
 */
Route::get('login', 'LoginController@login');

Route::post('login', 'LoginController@postLogin')->name('login');


/**
 * Route logout
 */
Route::get('logout', 'LoginController@logout')->name('logout');

/**
 * Route admin
 */
Route::prefix('admin')->middleware('admin')->group(function(){
	Route::get('keywordList','userController@keywordList');
});

/**
 * Route user
 */
