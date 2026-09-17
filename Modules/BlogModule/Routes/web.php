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

Route::prefix('blogs')->group(function() {
    Route::get('/', 'BlogModuleController@index')->name('guest.blogs');
    Route::get('/singleBlog/{id}', 'BlogModuleController@singleBlog')->name('guest.singleBlog');
});
Route::group(['prefix' => 'admin/blogs', 'middleware' => ['auth:admin']], function () {

    Route::get('/', 'Admin\BlogAdminController@index')->name('admin.blogs');
    Route::get('/add', 'Admin\BlogAdminController@create')->name('admin.blogs.add');
    Route::post('/store', 'Admin\BlogAdminController@store')->name('admin.blogs.store');
    Route::get('/view/{id}', 'Admin\BlogAdminController@show')->name('admin.blogs.view');
    Route::get('/edit/{id}', 'Admin\BlogAdminController@edit')->name('admin.blogs.edit');
    Route::post('/update', 'Admin\BlogAdminController@update')->name('admin.blogs.update');
    Route::get('/delete/{id}', 'Admin\BlogAdminController@delete')->name('admin.blogs.delete');
    Route::get('addTopservice/{id}', 'Admin\BlogAdminController@addTopblogs');
    Route::get('removeTopservice/{id}', 'Admin\BlogAdminController@removeTopservice');
});
