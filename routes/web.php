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

// Controller for the CRUD of information on members and teams
Route::resource('members', 'MemberController');
Route::resource('teams', 'TeamController');

// A collection of controllers on auth system
Auth::routes();

// Controller for home page
Route::get('/', 'HomeController@index')->name('home');


// Controller for enrollment
Route::get('enroll', 'EnrollController@create')->name('enroll');
Route::post('enroll', 'EnrollController@store');
