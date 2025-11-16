<?php

use App\Routes\Route;
use App\Controllers\SiteController;
use App\Controllers\ReservationController;
use App\Controllers\AuthController;

Route::get('/', 'SiteController@index');
Route::get('/sites', 'SiteController@index');
Route::post('/site/delete', 'SiteController@delete');
Route::get('/site/edit', 'SiteController@edit');
Route::post('/site/edit', 'SiteController@update');
Route::get('/site/create', 'SiteController@create');
Route::post('/site/create', 'SiteController@store');



Route::get('/login', 'AuthController@create');
Route::post('/login', 'AuthController@show');
Route::get('/logout', 'AuthController@delete');




Route::get('/reservations', 'ReservationController@index');
Route::get('/reservation/create', 'ReservationController@create');
Route::post('/reservation/create', 'ReservationController@store');
Route::get('/reservation/show', 'ReservationController@show');
Route::get('/reservation/edit', 'ReservationController@edit');
Route::post('/reservation/edit', 'ReservationController@update');
Route::post('/reservation/delete', 'ReservationController@delete');







Route::dispatch();
