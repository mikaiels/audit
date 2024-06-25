					<?php

use Illuminate\Support\Facades\Route;



Route::get('/', 'App\Http\Controllers\DashboardController@dashboard')->name('dashboard');


////////////////////////////// USER LOGIN
Route::post('login', 'App\Http\Controllers\UserController@login_action')->name('login.action');
Route::post('register', 'App\Http\Controllers\UserController@register_action')->name('register.action');
Route::post('password', 'App\Http\Controllers\UserController@password_action')->name('password.action');
Route::get('login', 'App\Http\Controllers\UserController@login')->name('login');
Route::get('register', 'App\Http\Controllers\UserController@register')->name('register');
Route::get('password', 'App\Http\Controllers\UserController@password')->name('password');
Route::get('logout', 'App\Http\Controllers\UserController@logout')->name('logout');



///////////////////////////  MENU UTAMA

Route::get('createJo', 'App\Http\Controllers\CreateJoController@index')->name('createJo');



////////////////////////////////////


Route::get('fullcalender', 'App\Http\Controllers\FullCalenderController@index')->name('index');
Route::post('fullcalenderAjax', 'App\Http\Controllers\FullCalenderController@ajax')->name('ajax');