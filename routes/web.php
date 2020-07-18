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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/reclamationsnt', 'HomeController@reclamationsnt')->name('reclamationsnt');

/** Admin reclamations */
Route::get('/admin/reclamations/encours', 'FireBaseController@index')->name('Firestore');
Route::get('/admin/reclamations/traitee', 'FireBaseController@reclamationsT')->name('reclamationsT');
Route::get('/document/{id}/delete', 'FireBaseController@delete')->name('deleteDocument');
Route::post('/reclamation/addp', 'FireBaseController@addPeriorite')->name('addPeriorite');


/** Cheef reclamations  */
Route::get('/cheef/reclamations/encours', 'FireBaseController@cheefencours')->name('cheefencours');
Route::get('/cheef/reclamations/traitee', 'FireBaseController@cheeftraitee')->name('cheeftraitee');
Route::get('/reclamation/{id}/valide', 'FireBaseController@changeState')->name('changeState');