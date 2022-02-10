<?php

use Illuminate\Support\Facades\Route;

Route::get('Admin',  function () {
    return redirect()->route('admin.login');
});



Route::group(['namespace' => 'Auth'], function () {
    # Login Routes
    Route::get('login',     'LoginController@showLoginForm')->name('login');
    Route::post('login',    'LoginController@login');
    Route::post('logout',   'LoginController@logout')->name('logout');
});
//group middleware
Route::group(['middleware' => 'auth:admin', ''], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    //book category
    Route::group(['prefix' => 'book', 'as' => 'book.'], function () {
        Route::get('category_view_list', 'BookCategoryController@index')->name('category_view_list');
        Route::get('storeCategory', 'BookCategoryController@storeCategory')->name('storeCategory');
        Route::get('create_category', 'BookCategoryController@create')->name('create_category');
        Route::get('edit/{id}', 'BookCategoryController@edit')->name('edit');
        Route::post('update_category/{id}', 'BookCategoryController@update')->name('update_category');
        Route::post('destroy_category', 'BookCategoryController@destroy')->name('destroy_category');
        Route::post('category_status', 'BookCategoryController@statuschange')->name('category_status');
        Route::get('book_view_list', 'BookController@index')->name('book_view_list');
        Route::get('create', 'BookController@create')->name('create');
        Route::post('store_book', 'BookController@store')->name('store_book');
        Route::get('book_edit/{id}', 'BookController@edit')->name('book_edit');
        Route::post('book_update/{id}', 'BookController@update')->name('book_update');
        Route::post('destroy_book', 'BookController@destroy')->name('destroy_book');

    });
        Route::group(['prefix' => 'bookissue', 'as' => 'bookissue.'], function () {
        Route::get('book_issue_view', 'BookissueController@index')->name('book_issue_view');
        Route::post('counfirm', 'BookissueController@counfirm')->name('counfirm');

        });
});
