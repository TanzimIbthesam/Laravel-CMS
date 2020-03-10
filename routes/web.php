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
// Defining a route using closure
// Route::get('/', function () {
//     return view('home');
// });
//Route::get('/contact', function () {
//     return view('contact');
// });
// In case of named parameters
// Route::view('/','home')->name('home');
//When we have a Controller
// Route::get('/','HelloController@home')->name('home');
Route::get('/contact','HelloController@contact')->name('contact');
Route::get('/secret','HomeController@secret')
->name('secret')
->middleware('can:home.secret');
;
Route::get('/blog-post/{id}/{welcome?}','HelloController@blogPost')->name('blog-post');
//
// Route::resource('/posts','PostsController')->only(['index','show','create','store']);
Route::resource('/posts','PostsController');
// Defining a route that only renders a blade template/
// Route::view('/contact','contact');
// Route with a required parameter
// Route::get('',function(){
//     $pages=[
//           1=>[
//               'title'=>'Hello From page 1'
//           ],
//           2=>[
//               'title'=>'Hello From page 2'
//           ],
//     ];
//     $welcomes=[1=>'Hello',2=>'Welcome to'];
// // return $id.$author;
// return view('blog-post',[
//     'data'=>$pages[$id],
//     'welcome'=>$welcomes[$welcome],
// ]);
// })->name('blog-post');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});
Route::get('posts/tag/{tag}','PostTagController@index')->name('posts.tags.index');



