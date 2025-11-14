<?php
// include 'routes/Route.php';
// include 'controllers/HomeController.php';

use App\Routes\Route;
use App\Controllers\SiteController;
use App\Controllers\ReservationController;

Route::get('/', 'SiteController@index');
Route::get('/sites', 'SiteController@index');
Route::get('/reservations', 'ReservationController@index');

Route::get('/reservation/create', 'ReservationController@create');
Route::post('/reservation/create', 'ReservationController@store');
Route::get('/reservation/show', 'ReservationController@show');
Route::get('/reservation/edit', 'ReservationController@edit');
Route::post('/reservation/edit', 'ReservationController@update');
Route::post('/reservation/delete', 'ReservationController@delete');

// Route::get('/reservations', 'ReservationController@index');

// Route::get('/reservation/create', 'ReservationController@create');
// Route::post('/reservation/create', 'ReservationController@store');
// Route::get('/reservation/edit', 'ReservationController@edit');
// Route::post('/reservation/edit', 'ReservationController@update');
// Route::post('/reservation/delete', 'ReservationController@delete');





Route::dispatch();
