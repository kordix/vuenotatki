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

// Route::get('/', function () {
//     return view('site');
// });


Route::resource('note','NoteController');
Route::resource('picture','PictureController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// Route::get('/{any}', function () {
//     return view('site');
// })->where('any', '.*');


Route::view('obrazki','site');

Route::get('/obrazki/{any}', function (){
    return view('site');})->where('any', '.*');
