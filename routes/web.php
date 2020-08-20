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

Route::get('/', 'GameController@index')->name('games');
Route::get('/game/{slug}', 'SingleGameController@index')->name('games.show');
Route::get('/error', function (){
    return view('404');
});
Route::get('/{text}', function (){
    return redirect('/error');
});
Route::post('/search', 'SearchController@index')->name('search');//->middleware('notEmptyInput');
