<?php

Route::get('/', ['as'=>'home', function(){
	return View::make('home');
}]);

Route::get('login', array('as'=>'login', 'uses'=>'UsersController@showLogin'))->before('guest');
Route::post('login', 'UsersController@doLogin');
Route::get('logout', ['as'=>'logout', 'uses'=>'UsersController@logout'])->before('auth');
Route::post('logout', 'UsersController@logout');
Route::get('register', 'UsersController@create')->after('guest');
Route::post('register', 'UsersController@store');
