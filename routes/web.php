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

/**
 * Route login, logout, register
 */
Route::get('login', 'Auth\LoginController@login')->name('loginForm')->middleware('guest');

Route::post('login', 'Auth\LoginController@processLogin')->name('login');

Route::get('logout', 'Auth\LoginController@logout');

Route::get('register', 'Auth\LoginController@register')->middleware('guest');

Route::post('register', 'Auth\LoginController@processRegister')->name('register');

/**
 * Route for logged-in user
 */
Route::group(['middleware'=>'checkLogin'],function(){
	Route::get('home','TranslationController@index')->name('translate');
	
	Route::post('home','TranslationController@postTranslate')->name('processTranslate');

	Route::post('check/unique/keyword', 'ValidationController@checkUniqueKeyword')->name('uniqueKeyword');

	Route::post('user/meaning/improve', 'UserController@improveMeaning')->name('improve-meaning');
});

/*
 * Route admin
 */

Route::prefix('admin')->middleware('admin')->group(function() {
    Route::get('keyword/list', 'Admin\AdminController@keywordList')->name('keyword-list');

    Route::get('meaning/list', 'Admin\AdminController@meaningList')->name('meaning-list');

    Route::get('add/keyword', 'Admin\AdminController@addKeyword');

    Route::post('add/keyword', 'Admin\AdminController@processAddKeyword')->name('adminAddKeyword');

    Route::get('deleteWord/{id}', 'Admin\AdminController@deleteWord');

    Route::get('editKeyword/{id}', 'Admin\AdminController@editKeyword');
    
    Route::post('editKeyword', 'Admin\AdminController@processEditKeyword')->name('keywordEditRoute');

    Route::post('ajax/get-detail-meaning', 'TranslationController@postDetailMeaning')->name('detail-meaning');
    // keyword temp table
    Route::prefix('keyword-temp')->group(function() {
        Route::get('list', 'Admin\AdminController@indexKeywordTemp')->name('keywordTempList'); // return view

        Route::post('list', 'Admin\AdminController@postDataForKeywordTemp');

        Route::post('approve', 'Admin\AdminController@approveChangesOnKeywordTable')->name('approveOnKeyword');

        Route::post('decline', 'Admin\AdminController@postDeclineChangesOnKeywordTable')->name('declineOnKeyword');

        Route::post('delete', 'Admin\AdminController@deleteRequest')->name('deleteRequest');
    });

    // meaning table
    Route::prefix('meaning-temp')->group(function() {
        Route::get('list', 'Admin\AdminController@indexMeaningTemp')->name('meaningTempList');

        Route::post('list', 'Admin\AdminController@postDataForMeaningTemp');

        Route::post('approve', 'Admin\AdminController@approveChangesOnMeaningTable')->name('approveOnMeaning');

        Route::post('decline', 'Admin\AdminController@postDeclineChangesOnMeaningTable')->name('declineOnMeaning');

        Route::post('delete', 'Admin\AdminController@deleteRequestOnMeaningTable')->name('deleteRequestMeaning');
    });
});