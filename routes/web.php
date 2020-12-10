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

Route::get('/', 'Site\SiteController@index');

Route::prefix('painel')->middleware('auth')->group(function(){
    Route::get('/', 'Admin\AdminController@index')->name('admin');

    //Browser Login
    Route::get('login', 'Admin\Auth\LoginController@index')->name('login');
    Route::post('login', 'Admin\Auth\LoginController@authenticate');

    //Browser Register
    Route::get('register', 'Admin\Auth\RegisterController@index')->name('register');
    Route::post('register', 'Admin\Auth\RegisterController@register');

    //Button Logout
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('logout');

    //Users
    Route::resource('users', 'Admin\UserController');

    //Profile
    Route::get('profile', 'Admin\ProfileController@index')->name('profile');
    Route::put('profilesave', 'Admin\ProfileController@save')->name('profile.save');

    //Route Settings
    Route::get('settings', 'Admin\SettingController@index')->name('settings');
    Route::any('settingssave', 'Admin\SettingController@save')->name('settings.save');

    //Pages Create
    Route::resource('pages', 'Admin\PageController');
});
