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
 * Route login, logout
 */
Route::get('login', 'Auth\LoginController@loginForm')->name('loginForm')->middleware('guest');

Route::post('login', 'Auth\LoginController@login')->name('login');

Route::get('logout', 'Auth\LoginController@logout');

/**
 * Route register
 */
Route::get('register', 'Auth\RegisterController@registerForm')->middleware('guest');

Route::post('register', 'Auth\RegisterController@register')->name('register');


Route::group(['middleware'=>'checkLogin'],function(){
	Route::get('translate','User\TranslateController@showPage');
	Route::post('search','User\TranslateController@search');
});
Route::group(['prefix'=>'user','middleware'=>'user'],function(){
	Route::get('keywordEdit/{id}', 'User\EditWordController@showEditPage');
	Route::post('keywordEdit', 'User\EditWordController@wordEdit');
});
Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
	Route::get('wordList','Admin\AdminController@wordList');
	Route::get('deleteWord/{id}','Admin\AdminController@deleteWord');
});


