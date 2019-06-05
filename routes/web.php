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

Route::middleware(['auth'])->group(function () {
	Route::get('/products', 'ProductController@index')->name('products');
	Route::post('/search', 'ProductController@search')->name('searchProducts');
	Route::get('/product/add', 'ProductController@add')->name('addProduct');
	Route::post('/product/add', 'ProductController@store')->name('storeProduct');
	Route::get('/product/edit/{id}', 'ProductController@edit')->name('editProduct');
	Route::post('/product/edit/{id}', 'ProductController@update');
	Route::get('/product/delete/{id}', 'ProductController@delete')->name('deleteProduct');
});