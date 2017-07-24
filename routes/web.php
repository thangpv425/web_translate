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
	Route::get('keywordList','userController@keywordList');
    Route::get('keywordAdd', 'userController@get_keywordAdd');
    Route::post('keywordAdd', 'userController@post_keywordAdd');
    
    Route::get('keywordEdit/{keyword_id}', 'userController@get_keywordEdit');
    Route::post('keywordEdit/{keyword_id}', 'userController@post_keywordEdit');

	// Route::get('approve')

	Route::get('queue/keyword', 'AdminController@keywordTempList'); // return view

	Route::get('approve/keyword/{id}/{opCode}', 'AdminController@keywordApprove')->name('approveOnKeyword')->where(['id' => '[0-9]+','opCode' => '[0-9]+']);

	Route::get('queue/meaning', 'AdminController@meaningTempList');
});

/**
 * Route user
 */
