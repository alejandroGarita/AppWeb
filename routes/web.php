<?php

Route::resource('/contact', 'ContactController');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::get('files/upload', 'HomeController@uploadFiles');
Route::post('files/upload', 'HomeController@storageFiles');
Route::get('/files/{id}', 'HomeController@showFiles');