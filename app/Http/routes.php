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

/*Route::get('/', 'WelcomeController@index');*/
Route::get('/', 'IndexController@showIndex');
Route::get('/login', 'IndexController@showIndex');
Route::get('/signin', function(){ return view('signin'); });
Route::get('/accueil', 'AnnoncesController@index');
Route::get('/mon_compte', function(){ return view('compte'); });
Route::get('/add', function(){ return view('add'); });
Route::get('/annonce/{id}', 'AnnoncesController@show');


Route::post('/Users/create', 'UsersController@create');
Route::post('/Users/login', 'UsersController@login');
Route::post('/Users/modification', 'UsersController@modification');
Route::get('/Users/logout', 'UsersController@logout');
Route::get('/Users/{id}/delete', 'UsersController@edit');

Route::post('/Annonces/create', 'AnnoncesController@create');
Route::get('/Annonces/{id}/delete', 'AnnoncesController@delete');
Route::any('/resultat', 'AnnoncesController@recherche');

Route::post('/Messages/{id}/create', 'MessagesController@create');

Route::get('/message_recu', 'MessagesController@index');
Route::get('/message_envoye', 'MessagesController@indexe');

Route::resource('Users', 'UsersController');
Route::resource('Index', 'IndexController');
Route::resource('Annonces', 'AnnoncesController');