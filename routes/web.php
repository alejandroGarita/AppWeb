<?php

Route::resource('contact', 'ContactController');
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
