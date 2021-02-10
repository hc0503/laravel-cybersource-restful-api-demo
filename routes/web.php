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

Route::get('/', function () {
    $pageTitle = __('global.comingSoon.title');

    return view('coming-soon', compact('pageTitle'));
});

Auth::routes();

Route::middleware(['auth', 'verified'])->group( function () {
    // Route::group(['middleware' => 'role:Admin', 'prefix' => 'portal', 'as'=>'portal.'], function () {
    Route::group(['prefix' => 'portal', 'as'=>'portal.'], function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('/users', 'Portals\UserController');
    });
});
