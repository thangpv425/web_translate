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
    return view('Authentication.login');
});

/**
 * Route register
 */
Route::get('register', 'RegisterController@register');

Route::post('register', 'RegisterController@postRegister')->name('register');

/**
 * Route login
 */
Route::get('login', 'LoginController@login')->name('loginForm');

Route::post('login', 'LoginController@postLogin')->name('login');

/**
 * Route logout
 */
Route::get('logout', 'LoginController@logout')->name('logout');

/**
 * Route admin
 */

Route::prefix('admin')->middleware('admin')->group(function(){

	Route::get('keywordList','KeywordListController@keywordList');

    
    Route::get('keywordAdd','KeywordListController@get_keywordAdd');
    Route::post('keywordAdd', 'KeywordListController@post_keywordAdd');

	Route::get('delete_word/{id}','KeywordListController@deleteWord');
	
	// keyword table
	Route::get('queue/keyword', 'AdminController@keywordTempList')->name('keywordTempList'); // return view

	Route::get('approve/keyword', 'AdminController@keywordApprove')->name('approveOnKeyword')->where(['id' => '[0-9]+','opCode' => '[0-9]+']);

	Route::get('decline/keyword', 'AdminController@keywordDecline')->name('declineOnKeyword');

	// meaning table
	Route::get('queue/meaning', 'AdminController@meaningTempList')->name('meaningTempList');

	Route::get('approve/meaning', 'AdminController@meaningApprove')->name('approveOnMeaning');

	Route::get('decline/meaning', 'AdminController@meaningDecline')->name('declineOnMeaning');
});

Route::group(['middleware'=>'loginned'],function(){
	
	Route::get('translate','TranslateController@showPage');
	
	Route::post('search','TranslateController@search');

    Route::get('user/view/{id}','UserController@view');

    Route::get('user/edit/{id}','UserController@edit');

    Route::post('user/edit/{id}','UserController@update');
});

/**
 * Route user
 */
