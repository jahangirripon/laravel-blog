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

// authentication routes
//Route::get('login', 'Auth\HomeController@getLogin');
//Route::post('login', 'Auth\HomeController@postLogin');
//Route::get('logout', 'Auth\HomeController@getLogout');

// registration routes
//Route::get('register', 'Auth\HomeController@getRegister');


//pages route
Route::get('contact','PagesController@getContact');
Route::post('contact','PagesController@postContact');
Route::get('about', 'PagesController@getAbout');


// blog post routes
Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);
Route::get('/', 'PagesController@getIndex');
Route::Resource('posts', 'PostController');
Route::get('blog/{slug}', ['as' => 'blog.single','uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');


// auth routes
Auth::routes();
Route::get('/main', 'HomeController@index');


//categories
Route::resource('categories', 'CategoryController', ['except' => ['create']]);


//tags
Route::resource('tags', 'TagController', ['except' => ['create']]);


//comments
Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
Route::put('comments/{id}/update', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);