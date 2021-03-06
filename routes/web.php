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

/*
* Patterns
*/

Route::pattern('id', '[0-9]+');

/* * * * */


/*
* Routes
*/

Route::get('/', 'HomepageController@index')->name('index');

Route::get('/error', 'HomepageController@error');

Route::get('/functest', 'CategoryController@restore');

Route::get('/account', 'UserController@account')->middleware('auth');


Route::post('/createProduct', 'ProductController@create')->name('createProduct');
Route::post('/editProduct', 'ProductController@edit')->name('editProduct');


Route::get('/produkt/{id}', 'ProductController@detail')->name('productDetail');


Route::get('/obchod', 'ProductController@overview')->name('shopOverview');

/* * * * */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
