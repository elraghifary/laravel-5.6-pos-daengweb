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
    Route::put('/user/permission/{role}', 'UserController@setRolePermission')->name('users.setRolePermission');

    Route::post('/user/permission', 'UserController@addPermission')->name('users.add_permission');

    Route::get('/user/role-permission', 'UserController@rolePermission')->name('users.roles_permission');

    Route::resource('/user', 'UserController')->except([
        'show'
    ]);

    Route::get('/user/roles/{id}', 'UserController@roles')->name('user.roles');

    Route::resource('/role', 'RoleController')->except([
        'create', 'show', 'edit', 'update'
    ]);

    Route::resource('/category', 'CategoryController')->except([
        'create', 'show'
    ]);

    Route::resource('/product', 'ProductController');

    Route::get('/home', 'HomeController@index')->name('home');
});
