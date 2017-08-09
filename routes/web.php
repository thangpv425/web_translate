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
    
    Route::get('add/keyword', 'Admin\AdminController@addKeyword');

    Route::post('add/keyword', 'Admin\AdminController@processAddKeyword')->name('adminAddKeyword');
    
    Route::get('deleteWord/{id}','Admin\AdminController@deleteWord');

    // keyword temp table
    Route::prefix('keyword-temp')->group(function(){
    	Route::get('list', 'Admin\AdminController@indexKeywordTemp')->name('keywordTempList'); // return view

		Route::post('list', 'Admin\AdminController@postDataForKeywordTemp');

		Route::post('approve', 'Admin\AdminController@approveChangesOnKeywordTable')->name('approveOnKeyword');

	    Route::post('decline', 'Admin\AdminController@declineChangesOnKeywordTable')->name('declineOnKeyword');

	    Route::post('delete', 'Admin\AdminController@deleteRequest')->name('deleteRequest');
    });

	// meaning table
	Route::prefix('meaning-temp')->group(function(){
		Route::get('list', 'Admin\AdminController@indexMeaningTemp')->name('meaningTempList');

		Route::post('list', 'Admin\AdminController@postDataForMeaningTemp');
		
		Route::post('approve', 'Admin\AdminController@approveChangesOnMeaningTable')->name('approveOnMeaning');

	    Route::post('decline', 'Admin\AdminController@declineChangesOnMeaningTable')->name('declineOnMeaning');

	    Route::post('delete', 'Admin\AdminController@deleteRequestOnMeaningTable')->name('deleteRequestMeaning');
	});
	
});
/**
 * Check validate
 */
Route::prefix('check')->middleware('checkLogin')->group(function(){
	Route::post('unique/keyword', 'ValidationController@checkUniqueKeyword')->name('uniqueKeyword');

});