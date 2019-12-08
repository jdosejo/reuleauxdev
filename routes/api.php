<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/member', function (Request $request) {
    return $request->member();
});

Route::middleware(['client', 'cors'])->group(function () {
    # BRANCHES
    # list branches
    Route::get('branches', 'BranchController@index');

    # get branch
    Route::get('branch/{id}', 'BranchController@show');

    # create new branch
    Route::post('branch', 'BranchController@store');

    # update branch
    Route::put('branch', 'BranchController@store');

    # delete branch
    Route::delete('branch/{id}', 'BranchController@destroy');

    #################################################################

    # CLASSIFICATION
    # list classifications
    Route::get('classifications', 'ClassificationController@index');

    # get classification
    Route::get('classification/{id}', 'ClassificationController@show');

    # create new classification
    Route::post('classification', 'ClassificationController@store');

    # update classification
    Route::put('classification', 'ClassificationController@store');

    # delete classification
    Route::delete('classification/{id}', 'ClassificationController@destroy');


    #################################################################

    # MEMBER
    # list members
    Route::get('members', 'MemberController@index');

    # get member
    Route::get('member/{id}', 'MemberController@show');

    # create new member
    Route::post('member', 'MemberController@store');

    # update member
    Route::put('member', 'MemberController@store');
    Route::put('scan', 'MemberController@scan');

    # delete member
    Route::delete('member/{id}', 'MemberController@destroy');
});

// Route::post('register', 'ApiAuthController@register');
Route::post('login', 'ApiAuthController@login');





