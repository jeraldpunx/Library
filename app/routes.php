<?php
//GLOBAL VARIABLES
if(Auth::check()) {
	$borrowers = User::join('borrowers', 'borrowers.id', '=', 'users.borrower_id')
				->Where('borrowers.id', '=', Auth::user()->borrower_id)
				->get();
	View::share('borrowers', $borrowers);
	
	$bookUnreturn = DB::table('transactions')
	        		->leftJoin('books', 'transactions.book_id', '=', 'books.id')
	        		->Where('borrower_id', '=', Auth::user()->borrower_id)
	        		->whereNotNull('borrowedDate')
	        		->whereNull('returnedDate')
				    ->count();
	View::share('bookUnreturn', $bookUnreturn);
}
View::share('companyName', 'USJR Library');



Route::get('/', ['as'=>'home', function(){
	if(Auth::check()) {
		if(Auth::user()->previlage == 0)
			return View::make('admin.index');
		else {
			return View::make('search');
		}
	} else {
		return View::make('search');
	}
}]);
//NORMAL
Route::get('login',                ['as'=>'login',    'uses'=>'UsersController@showLogin'])->before('guest');
Route::post('login',               'UsersController@doLogin');
Route::get('logout',               ['as'=>'logout',   'uses'=>'UsersController@logout'])->before('auth');
Route::get('register',             ['as'=>'register', 'uses'=>'UsersController@create'])->before('guest');
Route::post('register',            'UsersController@store');
Route::post('result-search-data',  'UsersController@resultSearchData');
Route::get('userBooks',            ['as'=>'userBooks',    'uses'=>'UsersController@userBooks']);

//NORMAL USER
Route::group(array('before'=>'normalUser'), function(){
	//AJAX
	Route::post('request-book-data', 'UsersController@requestBookData');
	Route::post('delete-request',    'UsersController@deleteRequest');

	//MANAGE USER
	Route::get('manageProfile',   ['as'=>'manageProfile',  'uses'=>'UsersController@manageProfile']);
	Route::post('changeProfile',  ['as'=>'changeProfile',  'uses'=>'UsersController@changeProfile']);
	Route::post('changePassword', ['as'=>'changePassword', 'uses'=>'UsersController@changePassword']);
	
	//TRANSACTION
	Route::get('userHistory',  ['as'=>'userHistory',  'uses'=>'UsersController@userHistory']);
	Route::get('userRequest',  ['as'=>'userRequest',  'uses'=>'UsersController@userRequest']);
	Route::get('userUnreturn', ['as'=>'userUnreturn', 'uses'=>'UsersController@userUnreturn']);
});

//ADMIN
Route::group(array('before'=>'adminUser'), function(){
	//MANAGE BOOKS
	Route::get('books',             ['as'=>'books',        'uses'=>'AdminController@books']);
	Route::get('books/add',         ['as'=>'books/add',    'uses'=>'AdminController@addBooks']);
	Route::post('books/create',     ['as'=>'books/create', 'uses'=>'AdminController@createBooks']);
	Route::get('books/{id}/edit',   ['as'=>'books/edit',   'uses'=>'AdminController@editBooks']);
	Route::put('books/{id}',        ['as'=>'books/update', 'uses'=>'AdminController@updateBooks']);
	Route::get('books/delete/{id}', ['as'=>'books/delete', 'uses'=>'AdminController@deleteBooks']);

	//MANAGE BORROWERS
	Route::get('borrowers',             ['as'=>'borrowers',        'uses'=>'AdminController@borrowers']);
	Route::get('borrowers/add',         ['as'=>'borrowers/add',    'uses'=>'AdminController@addBorrowers']);
	Route::post('borrowers/create',     ['as'=>'borrowers/create', 'uses'=>'AdminController@createBorrowers']);
	Route::post('users/create',         ['as'=>'users/create',     'uses'=>'AdminController@createUsers']);
	Route::get('borrowers/{id}/edit',   ['as'=>'borrowers/edit',   'uses'=>'AdminController@editBorrowers']);
	Route::put('borrowers/{id}',        ['as'=>'borrowers/update', 'uses'=>'AdminController@updateBorrowers']);
	Route::put('users/{id}',            ['as'=>'users/update',     'uses'=>'AdminController@updateUsers']);
	Route::get('borrowers/delete/{id}', ['as'=>'borrowers/delete', 'uses'=>'AdminController@deleteBorrowers']);
	Route::get('borrowers/view/{id}/history',  ['as'=>'borrowers/view/history', 'uses'=>'AdminController@viewBorrowerHistory']);
	Route::get('borrowers/view/{id}/request',  ['as'=>'borrowers/view/request', 'uses'=>'AdminController@viewBorrowerRequest']);
	Route::get('borrowers/view/{id}/unreturn',  ['as'=>'borrowers/view/unreturn', 'uses'=>'AdminController@viewBorrowerUnreturn']);
	
	//TRANSACTION
	Route::get('adminHistory',  ['as'=>'adminHistory',  'uses'=>'AdminController@adminHistory']);
	Route::get('adminRequest',  ['as'=>'adminRequest',  'uses'=>'AdminController@adminRequest']);
	Route::get('adminUnreturn', ['as'=>'adminUnreturn', 'uses'=>'AdminController@adminUnreturn']);
	Route::get('issueBook',     ['as'=>'issueBook',     'uses'=>'AdminController@issueBook']);
	Route::post('issueBookPost',['as'=>'issueBookPost', 'uses'=>'AdminController@storeIssueBook']);
	Route::get('requestNotifications', 	['as'=>'requestNotifications', 'uses'=>'AdminController@requestNotifications']);

	//AJAX
	Route::post('approve-request',      'AdminController@approveRequest');
	Route::post('return-book',          'AdminController@returnBook');
	Route::get('searchBorrowersCode',   'AdminController@searchBorrowersCode');
	Route::post('result-borrower-code', 'AdminController@resultBorrowerCode');
	Route::get('searchISBN',            'AdminController@searchISBN');
	Route::post('result-ISBN',          'AdminController@resultISBN');
});



Route::get('test', function() {
	return View::make('include.footer');
});