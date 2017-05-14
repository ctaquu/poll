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
    return view('welcome');
});

Route::get('home', function () {
    return view('welcome');
});

Route::get('unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');

Auth::routes();

Route::get('user/activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');

Route::resource('admin/polls', 'Admin\PollController');
Route::resource('admin/users', 'Admin\UserController');

Route::resource('polls', 'PollController');
