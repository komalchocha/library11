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
        Route::post('destroy_category', 'BookCategoryController@destroy')->name('destroy_category');
        Route::get('book_view_list', 'BookController@index')->name('book_view_list');
        Route::get('create', 'BookController@create')->name('create');
        Route::post('store_book', 'BookController@store')->name('store_book');
    });

});
