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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/create', 'AppController@create')->name('app_create');
Route::post('new', 'AppController@new')->name('app_new');
Route::get('/app/{id}', 'AppController@index')->name('app_home');
Route::get('/task_detail/{id}', 'AppController@task_detail')->name('task_detail');
Route::get('/task_edit/{id}', 'AppController@task_edit')->name('task_edit');
Route::get('/design/{id}', 'AppController@design')->name('design');
Route::get('/transition/{id}', 'AppController@transition')->name('transition');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
