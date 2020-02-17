<?php

Route::resource('/contact', 'ContactController');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::get('messages/addFiles', 'MessageController@addFiles');
Route::post('messages/storageFiles', 'MessageController@storageFiles');
Route::get('messages/{id}/destroy', 'MessageController@delete');
Route::get('messages/sendMails', 'MessageController@sendMails');