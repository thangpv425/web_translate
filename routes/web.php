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
	return redirect()->route('loginForm');
});

Route::get('home', function(){
	echo "Content";
});

/**
 * Route guest
 */
Route::get('login', 'Auth\LoginController@loginForm')->name('loginForm')->middleware('guest');

Route::post('login', 'Auth\LoginController@login')->name('login');

Route::get('logout', 'Auth\LoginController@logout');

Route::get('register', 'Auth\LoginController@registerForm')->middleware('guest');

Route::post('register', 'Auth\LoginController@register')->name('register');

/**
 * Route admin
 */
Route::prefix('admin')->middleware('admin')->group(function(){
	// keyword table
	Route::get('queue/keyword', 'admin\AdminController@listKeywordTemp')->name('keywordTempList'); // return view

	Route::get('approve/keyword', 'admin\AdminController@approveKeyword')->name('approveOnKeyword')->where(['id' => '[0-9]+','opCode' => '[0-9]+']);

	Route::get('decline/keyword', 'admin\AdminController@declineKeyword')->name('declineOnKeyword');
	
	// meaning table
	Route::get('queue/meaning', 'admin\AdminController@listMeaningTemp')->name('meaningTempList');

	Route::get('approve/meaning', 'admin\AdminController@approveMeaning')->name('approveOnMeaning');

	Route::get('decline/meaning', 'admin\AdminController@declineMeaning')->name('declineOnMeaning');
});

/**
 * Route user
 */
