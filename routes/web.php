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
Route::post('/add-category','Admin\CategoryController@store');
Route::get('/categories','Admin\CategoryController@index');
Route::get('/get-category/{id}','Admin\CategoryController@show');
Route::post('/update-category/{id}','Admin\CategoryController@update');
Route::get('/category-delete/{id}','Admin\CategoryController@destroy');
Route::get('/posts','Admin\PostController@index');
