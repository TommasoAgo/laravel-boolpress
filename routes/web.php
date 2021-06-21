<?php

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
use Illuminate\Support\Facades\Auth; 

Auth::routes();

// Public Home Route
Route::get('/', 'HomeController@index')->name('home');

// Public Posts
RoutE::get('/blog', 'PostController@index');

// Admin Routes
Route::prefix('admin')
->namespace('Admin')
->name('admin.')
->middleware('auth')
->group(function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('posts', 'PostController');
});

