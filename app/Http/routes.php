<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/contributor', 'HomeController@contributor');

Route::get('/listnote/{id_contributor}', 'HomeController@list_note_by_contributor');

Route::get('/view/{id_note}', 'HomeController@view');

Route::post('/searchn', 'HomeController@find_note');

Route::get('/download/{id_note}', 'HomeController@download');

Route::get('/note', ['as'=>'note','uses'=>'NoteController@index']);

Route::get('/update/{id_note}', 'NoteController@update');

Route::post('/update/{id_note}', 'NoteController@update');

Route::get('/delete/{id_note}', 'NoteController@destroy');

Route::get('/contributor/{id_note}', ['as'=>'contributor','uses'=>'NoteController@contributor']);

Route::post('/searchc','NoteController@find_contributor');

Route::get('/addc/{id_user}/{id_note}','NoteController@update_contributor');

Route::get('/deletec/{id_user_to_note}','NoteController@deletec');

