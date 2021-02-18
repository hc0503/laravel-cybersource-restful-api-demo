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
    Route::group(['prefix' => 'portal', 'as' => 'portal.'], function () {
        Route::get('home', 'HomeController@index')->name('home');

        Route::group(['prefix' => 'profiles', 'as' => 'profiles.'], function () {
            Route::get('show/{guid}', 'Portals\ProfileController@show')->name('show');
            Route::get('edit/{guid}', 'Portals\ProfileController@edit')->name('edit');
            Route::post('update/{guid}', 'Portals\ProfileController@update')->name('update');
        });

        Route::group(['prefix' => 'usermanage', 'as' => 'usermanage.'], function () {
            Route::resource('users', 'Portals\UserController');
            Route::get('login/{guid}', 'Portals\UserController@loginUsingId')->name('users.login');
            Route::resource('roles', 'Portals\RoleController');
            Route::resource('permissions', 'Portals\PermissionController');
        });

        Route::resource('genres', 'Portals\GenreController');
        Route::resource('magazines', 'Portals\MagazineController');
        Route::resource('documents', 'Portals\DocumentController');

        Route::group(['prefix' => 'emails', 'as' => 'emails.'], function () {
            Route::get('compose', 'Portals\MailController@viewCompose')->name('compose');
            Route::post('send', 'Portals\MailController@sendEmail')->name('send');
        });
    });
});
