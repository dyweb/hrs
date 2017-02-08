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

// Controller for the CRUD of member information
Route::resource('members', 'MemberController');

// A collection of controllers on auth system
Auth::routes();

// Controller for home page
Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
