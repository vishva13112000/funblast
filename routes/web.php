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
    return redirect()->route('login');
});

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

  
});

Route::group(['prefix' => 'branch'], function () {
  Route::get('/login', 'BranchAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'BranchAuth\LoginController@login');
  Route::post('/logout', 'BranchAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'BranchAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'BranchAuth\RegisterController@register');

  Route::post('/password/email', 'BranchAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'BranchAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'BranchAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'BranchAuth\ResetPasswordController@showResetForm');


});
