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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/{any}', 'HomeController@index')->where('any','.*');
Route::get('/home', 'HomeController@index')->name('home');

//Categories
Route::post('/add-category','Admin\CategoryController@store');
Route::get('/categories','Admin\CategoryController@index');
Route::get('/get-category/{id}','Admin\CategoryController@show');
Route::post('/update-category/{id}','Admin\CategoryController@update');
Route::get('/category-delete/{id}','Admin\CategoryController@destroy');
Route::post('/category/delete/all','Admin\CategoryController@deleteAllItems');
Route::post('/category/status-change','Admin\CategoryController@statusChange');

//Posts
Route::get('/posts','Admin\PostController@index');
Route::get('/get-categories','Admin\PostController@showCategories');
Route::post('/create-post','Admin\PostController@store');
Route::get('/post-delete/{id}','Admin\PostController@destroy');
Route::post('/post/delete/all','Admin\PostController@deleteAllPosts');
Route::post('/posts/status-change','Admin\PostController@statusChange');
