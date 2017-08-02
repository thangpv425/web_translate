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
 * Route login, logout, register
 */
Route::get('login', 'Auth\LoginController@login')->name('loginForm')->middleware('guest');

Route::post('login', 'Auth\LoginController@processLogin')->name('login');

Route::get('logout', 'Auth\LoginController@logout');

Route::get('register', 'Auth\LoginController@register')->middleware('guest');

Route::post('register', 'Auth\LoginController@processRegister')->name('register');

Route::group(['middleware'=>'checkLogin'],function(){
	Route::get('translate','User\TranslateController@showPage');
	
	Route::post('search','User\TranslateController@search');
});

/*
 * Route admin 
 */

Route::prefix('admin')->middleware('admin')->group(function(){
    Route::get('keywordList','Admin\AdminController@wordList');
    
    Route::get('keywordAdd', 'Admin\AdminController@getKeywordAdd');
    
    Route::post('keywordAdd', 'Admin\AdminController@postKeywordAdd');
    // keyword table
	Route::get('queue/keyword', 'Admin\AdminController@keywordTempList')->name('keywordTempList'); // return view

	Route::post('approve/keyword', 'Admin\AdminController@approveChangesOnKeywordTable')->name('approveOnKeyword')->where(['id' => '[0-9]+','opCode' => '[0-9]+']);

	Route::post('decline/keyword', 'Admin\AdminController@declineChangesOnKeywordTable')->name('declineOnKeyword');

	Route::post('deleteRequest', 'Admin\AdminController@deleteRequest')->name('deleteRequest');

	// meaning table
	Route::get('queue/meaning', 'Admin\AdminController@meaningTempList')->name('meaningTempList');

	Route::post('approve/meaning', 'Admin\AdminController@approveChangesOnMeaningTable')->name('approveOnMeaning');

	Route::post('decline/meaning', 'Admin\AdminController@declineChangesOnMeaningTable')->name('declineOnMeaning');

});
