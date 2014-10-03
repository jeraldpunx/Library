<?php
View::share('companyName', 'Punx');
Route::get('/', ['as'=>'home', function(){
	if(Auth::check()) {
		if(Auth::user()->previlage == 0)
			return View::make('admin.index');
		else
			return View::make('search');
	} else {
		return View::make('search');
	}
	
	// User::create([
	// 	'username'=>'admin',
	// 	'password'=>Hash::make('123'),
	// 	'previlage'=>0
	// ]);

	// Book::create([
	// 	'ISBN'=>'ABC005',
	// 	'title'=>'Fucktard',
	// 	'author'=>'JC Mamits',
	// 	'description'=>'Fuck',
	// 	'category'=>'Indie',
	// 	'quantity'=>10
	// ]);
	// Book::create([
	// 	'ISBN'=>'ABC006',
	// 	'title'=>'What the fuck',
	// 	'author'=>'Kevin Tabada',
	// 	'description'=>'Tuara',
	// 	'category'=>'Action',
	// 	'quantity'=>10
	// ]);
	// Book::create([
	// 	'ISBN'=>'ABC001',
	// 	'title'=>'We are electric',
	// 	'author'=>'Jerald Punx',
	// 	'description'=>'Fuck',
	// 	'category'=>'Indie',
	// 	'quantity'=>10
	// ]);
	// Book::create([
	// 	'ISBN'=>'ABC002',
	// 	'title'=>'Superman',
	// 	'author'=>'Jerald Punx',
	// 	'description'=>'Tuara',
	// 	'category'=>'Action',
	// 	'quantity'=>10
	// ]);
	// return "Done";
}]);
//NORMAL
Route::get('login', ['as'=>'login', 'uses'=>'UsersController@showLogin'])->before('guest');
Route::post('login', 'UsersController@doLogin');
Route::get('logout', ['as'=>'logout', 'uses'=>'UsersController@logout'])->before('auth');
Route::get('profile', ['as'=>'profile', 'uses'=>'UsersController@profile'])->before('auth');
Route::get('register', ['as'=>'register', 'uses'=>'UsersController@create'])->before('guest');
Route::post('register', 'UsersController@store');
//ADMIN

//BORROWER
  //AJAX
Route::post('result-search-data', 'UsersController@resultSearchData');
Route::post('request-book-data', 'UsersController@requestBookData');
Route::post('delete-request', 'UsersController@deleteRequest');

Route::get('manageProfile', ['as'=>'manageProfile', 'uses'=>'UsersController@manageProfile']);
Route::get('userHistory', ['as'=>'userHistory', 'uses'=>'UsersController@userHistory']);
Route::get('userRequest', ['as'=>'userRequest', 'uses'=>'UsersController@userRequest']);
Route::get('userUnreturn', ['as'=>'userUnreturn', 'uses'=>'UsersController@userUnreturn']);