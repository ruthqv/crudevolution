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

// Route::get('/crudevolution', 'Api\CrudEvolutionController@index');
// Route::get('/crud', 'Api\CrudController@index');
Route::get('/{path?}', function(){
	return view('main');
});