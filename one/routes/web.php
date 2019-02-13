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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('records', function () {
//     return view('record.records');
// });

Route::get('records', 'RecordController@records');

Route::get('records/create', 'RecordController@recordCreate');

Route::post('records/create', 'RecordController@create');

Route::get('records/edit/{record}', 'RecordController@edit');

Route::post('records/edit/{record}', 'RecordController@update');

Route::delete('records/delete/{record}', 'RecordController@delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');