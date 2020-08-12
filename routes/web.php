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

Route::get('/', 'HomepageController@index');

Route::get('/error', 'HomepageController@error');

Route::post('/createProduct', 'ProductController@create');
Route::post('/editProduct', 'ProductController@edit');


Route::get('product/{id}', 'ProductController@detail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* * * * */
