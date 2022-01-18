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
Route::post('user-login','Auth\LoginController@login');
Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/dashboard', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/forget-password', 'Auth\LoginController@forgotPassword');  // Grid List

Route::get('/products', 'Admin\ProductsController@index');  // Grid List
Route::get('/create-products', 'Admin\ProductsController@create'); // Create Form
Route::get('/edit-products/{id}', 'Admin\ProductsController@edit'); // Edit Form
Route::get('/view-products/{id}', 'Admin\ProductsController@view'); // Edit Form
Route::post('/store-products', 'Admin\ProductsController@store'); // To store record
Route::post('/update-products', 'Admin\ProductsController@update'); // To update recordseller/update-products
Route::get('/delete-products/{id}', 'Admin\ProductsController@destroy'); // To delete reecord
Route::post('/status-products','Admin\ProductsController@changeStatus'); // status 0 = Active 1 = Inctive

Route::post('/category-list','Admin\ProductsController@getCategory');

// ******************* BEGIN CATEGORY MODULE ***********************

Route::get('/category', 'Admin\CategoryController@index');  // Grid List
Route::post('/store-update-category', 'Admin\CategoryController@store'); // To store record
Route::post('/delete-category', 'Admin\CategoryController@destroy'); // To delete reecord
Route::post('/status-category','Admin\CategoryController@changeStatus'); // status 0 = Active 1 = Inctive

// ******************* END CATEGORY MODULE ***********************

// ******************* BEGIN SUB CATEGORY MODULE ***********************

Route::get('/sub-category', 'Admin\SubCategoryController@index');  // Grid List
Route::post('/store-update-sub-category', 'Admin\SubCategoryController@store'); // To store record
Route::get('/delete-sub-category/{id}', 'Admin\SubCategoryController@destroy'); // To delete reecord
Route::post('/status-sub-category','Admin\SubCategoryController@changeStatus'); // status 0 = Active 1 = Inctive

// ******************* END SUB CATEGORY MODULE ***********************
