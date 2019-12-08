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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    if (Auth::user()) {
        return redirect('dashboard');
    }
    return redirect('login');
});

//Route::post('login', 'ApiAuthController@login')->name('login');
Route::get('login', 'PageController@login')->name('login');
Route::get('dashboard', 'PageController@index')->name('dashboard');
Route::get('member/list', 'PageController@members');
Route::get('branch/list', 'PageController@branches');
Route::get('profiling', 'PageController@profiling');
Route::post('uploadPic', 'PageController@uploadPic');

Route::post('authenticate/login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');

Route::post('register', 'AuthController@register');
Route::get('getScan', 'AuthController@getScan');
