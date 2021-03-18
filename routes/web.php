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

Auth::routes();

Route::middleware(['auth', 'verified'])->group( function () {
    // Route::group(['middleware' => 'role:Admin', 'prefix' => 'portal', 'as'=>'portal.'], function () {
    Route::group(['prefix' => 'portal', 'as' => 'portal.'], function () {
        Route::get('/', function () {
            return redirect()->route('portal.home');
        });
        Route::get('home', 'Portals\HomeController@index')->name('home');

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
    });
});

Route::get('/', function () {
    return redirect('portal/home');
});
