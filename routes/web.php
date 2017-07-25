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
})->middleware('visitor');

/**
 * Route register
 */
Route::get('register', 'RegisterController@register')->middleware('visitor');

Route::post('register', 'RegisterController@postRegister')->name('register');

/**
 * Route login
 */
Route::get('login', 'LoginController@login')->name('loginForm')->middleware('visitor');

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

    
    Route::get('keywordAdd','AdminActionController@get_keywordAdd');
    Route::post('keywordAdd', 'AdminActionController@post_keywordAdd');
    Route::get('keywordEdit/{id}', 'AdminActionController@get_keywordEdit');
    Route::post('keywordEdit', 'AdminActionController@post_keywordEdit')->name('keywordEditRoute');

    Route::get('delete_word/{id}','KeywordListController@deleteWord');
	
	// keyword table
	Route::get('queue/keyword', 'AdminController@keywordTempList')->name('keywordTempList'); // return view

	Route::get('approve/keyword', 'AdminController@keywordApprove')->name('approveOnKeyword')->where(['id' => '[0-9]+','opCode' => '[0-9]+']);

	Route::get('decline/keyword', 'AdminController@keywordDecline')->name('declineOnKeyword');

	// meaning table
	Route::get('queue/meaning', 'AdminController@meaningTempList')->name('meaningTempList');

	Route::get('approve/meaning', 'AdminController@meaningApprove')->name('approveOnMeaning');

	Route::get('decline/meaning', 'AdminController@meaningDecline')->name('declineOnMeaning');

	// show list user
    Route::get('show', 'AdminController@show');

    // create user
    Route::get('create', 'AdminController@create');

    // store user
    Route::post('store', 'AdminController@store');
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
Route::prefix('user')->middleware('user')->group(function(){

	Route::get('keywordList','KeywordListController@keywordList');
    
    Route::get('keywordAdd','UserActionController@get_keywordAdd');
    Route::post('keywordAdd', 'UserActionController@post_keywordAdd');
    Route::get('keywordEdit/{id}', 'UserActionController@get_keywordEdit');
    Route::post('keywordEdit', 'UserActionController@post_keywordEdit');
    
	Route::get('delete_word/{id}','UserActionController@deleteWord');
	
});