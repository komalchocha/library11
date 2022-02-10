<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Auth::routes();


Route::group( ['middleware' => 'auth:web', ''],function () {

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/welcome_library', [App\Http\Controllers\User\UserController::class, 'index']);
Route::post('store', [App\Http\Controllers\Admin\BookissueController::class,'store'])->name('store');
Route::get('viewbook/{id}', [App\Http\Controllers\Admin\BookissueController::class, 'book'])->name('viewbook');
    
});