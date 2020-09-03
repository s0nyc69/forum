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

Route::name('admin.')->prefix('admin')->namespace('Admin')->group(function () {

    Route::get('/thread/{channel:slug}/{thread}', 'ThreadController@show')->name('thread.show');

    Route::resource('threads', 'ThreadController')->except([
        'show',
    ]);

    Route::resource('posts', 'PostController');
});

Route::get('/home', 'HomeController@index')->name('home');
