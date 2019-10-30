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
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('checkUserEmailExists', 'HomeController@checkUserEmailExists');

// Functions accessed by only authenticated users

Route::group(['middleware' => 'auth'], function(){

    // Functions accessed by only admin users 
    Route::group(['middleware' => ['role:administrator']], function() {
        Route::get('admin/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');

        Route::get('admin/users', 'Admin\UserController@index')->name('admin.users');
        Route::get('admin/create-user', 'Admin\UserController@create')->name('admin.createUser');
        Route::get('admin/edit-user/{user_id}', 'Admin\UserController@edit')->name('admin.editUser');
        Route::post('admin/save-user', 'Admin\UserController@saveUser')->name('admin.saveUser');
        Route::post('admin/delete-user', 'Admin\UserController@delete')->name('admin.deleteUser');
    });
});


