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

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
	Route::group(['prefix' => 'category'], function () {
		Route::get('/add', 'CategoryController@add');
	    Route::post('/store', 'CategoryController@store')->name('category.store');
	    Route::get('/{id}/edit', 'CategoryController@edit');
	    Route::post('/{id}/update', 'CategoryController@update')->name('category.update');
	    Route::delete('/{id}/delete', 'CategoryController@destroy')->name('category.delete');
	});

	Route::group(['prefix' => 'blog'], function () {
		Route::get('/add', 'PostController@add');
	    Route::post('/store', 'PostController@store')->name('blog.store');
	    Route::get('/{id}/edit', 'PostController@edit');
	    Route::post('/{id}/update', 'PostController@update')->name('blog.update');
	    Route::delete('/{id}/delete', 'PostController@destroy')->name('blog.delete');
	});
});


Route::get('/category', 'CategoryController@index');
Route::get('/category/{slug}', 'CategoryController@detail');

Route::get('/blog', 'PostController@index');
Route::get('/blog/{slug}', 'PostController@detail');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('post', 'PostController@create')->name('post.create');
Route::post('post', 'PostController@store')->name('post.store');
Route::get('/posts', 'PostController@index')->name('posts');
Route::get('/article/{post:slug}', 'PostController@show')->name('post.show');
Route::post('/comment/store', 'CommentController@store')->name('comment.add');
Route::post('/reply/store', 'CommentController@replyStore')->name('reply.add');