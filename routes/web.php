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
Route::get('/judgmentJoin/{id}', 'AppController@judgmentJoin')->name('judgment_join');
Route::get('/create', 'AppController@create')->name('app_create');
Route::post('new', 'AppController@app_new')->name('app_new');
Route::get('/app/{id}', 'AppController@index')->name('app_home');
Route::get('/app_edit/{id}', 'AppController@app_edit')->name('app_edit');
Route::post('/app_update/{id}', 'AppController@app_update')->name('app_update');
Route::get('/app_delete/{id}', 'AppController@app_delete')->name('app_delete');
Route::post('/add_member/{id}', 'AppController@add_member')->name('add_member');
Route::post('/add_screen/{id}', 'AppController@add_screen')->name('add_screen');
Route::get('/screen_detail/{id}', 'AppController@screen_detail')->name('screen_detail');
Route::get('/task_detail/{id}', 'AppController@task_detail')->name('task_detail');
Route::get('/task_edit/{id}', 'AppController@task_edit')->name('task_edit');
Route::get('/task_delete/{id}', 'AppController@task_delete')->name('task_delete');
Route::get('/design/{id}', 'AppController@design')->name('design');
Route::post('/design_edit/{id}', 'AppController@design_edit')->name('design_edit');
Route::get('/transition/{id}', 'AppController@transition')->name('transition');
Route::get('/transition_edit/{id}', 'AppController@transition_edit')->name('transition_edit');
Route::post('/trandition_update/{id}', 'AppController@transition_update')->name('transition_update');

Auth::routes();///

Route::get('/home', 'HomeController@index')->name('home');
