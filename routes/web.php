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

Route::get('/', 'ProductController@index')->name('products.root');

Route::resource('/products', 'ProductController');
Route::get('/products/{product}/delete', 'ProductController@delete')->name('products.delete');

Route::resource('/types', 'TypeController');
Route::get('/types/{type}/delete', 'TypeController@delete')->name('types.delete');

Route::resource('/attributes', 'AttributeController');
Route::get('/attributes/{attribute}/delete', 'AttributeController@delete')->name('attributes.delete');