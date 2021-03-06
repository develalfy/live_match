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


Route::get('/', 'HomeController@index')->name('home');
Route::get('/match/{id}', 'HomeController@show')->name('user.match');

/**
 * Admin Area
 */
Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@home')->name('dashboard');
    Route::resource('moderator', 'ModeratorController');
    Route::resource('team', 'TeamController');
    Route::resource('match', 'MatchController');
    Route::resource('match/{id}/comment', 'CommentController');
});

/**
 * Authentication Routes...
 */
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

/**
 * Registration Routes... will be disabled
 **/
/*$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');*/

Route::get('/home', 'HomeController@index')->name('home');
