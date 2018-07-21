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

Route::get('/', function() {
    return redirect(route('login'));
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::resource('/role', 'RoleController')->except([
        'create', 'show', 'edit', 'update'
    ]);

    Route::resource('/category', 'CategoryController')->except([
        'create', 'show'
    ]);

    Route::resource('/product', 'ProductController');

    Route::get('/home', 'HomeController@index')->name('home');
});
