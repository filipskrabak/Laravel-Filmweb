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

Route::get('/serialy', function () {
    return view('serialy');
});

*/

Route::get('/novinky', 'FilmsController@viewFilmsByRating');
Route::get('/', 'FilmsController@viewFilmsByRating');

Route::post('/pridat-film/submit', 'FilmsController@Submit');
Route::post('/film/{id}/submit', 'CommentsController@Submit');
Route::get('/film/comment/{id}/delete', 'CommentsController@Delete');

Route::get('/pridat-film', 'FilmsController@getRecords');
Route::get('/filmy', 'FilmsController@viewFilms');
Route::get('/serialy', 'FilmsController@viewShows');
Route::get('/search', 'FilmsController@search');

Route::get('/film/{id}', 'FilmsController@index')->name('fs.show');

Route::get('/zaner/filmy/{id}', 'CatsController@indexFilm');
Route::get('/zaner/serialy/{id}', 'CatsController@indexSerial');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('profil',  ['as' => 'users.edit', 'uses' => 'UserController@edit']);
Route::patch('profil/update',  ['as' => 'users.update', 'uses' => 'UserController@update']);
