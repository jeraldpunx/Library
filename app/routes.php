<?php
View::share('companyName', 'Punx');
Route::get('/', ['as'=>'home', function(){
	if(Auth::check()) {
		if(Auth::user()->previlage == 0)
			return View::make('admin.index');
		else
			return View::make('users.search');
	} else {
		return View::make('users.search');
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
Route::post('result-search-data', 'UsersController@resultSearchData');
Route::post('request-book-data', function() {
	if(Request::ajax()) {
		$borrowerId = DB::table('borrowers')
        				->leftJoin('users', 'borrowers.user_id', '=', 'users.id')
						->select('borrowers.id')
						->Where('users.id', '=', Input::get('userId'))
			            ->get();
		$borrowerId = $borrowerId[0]->id;
		$bookId = Input::get('bookId');

		$checkTransaction = DB::table('transactions')
					->Where('borrower_id', '=', $borrowerId)
					->Where('book_id', '=', $bookId)
					->where(function($query)
					{
						$query->where(function($query1) {
							$query1->whereNotNull('reservedDate')
								   ->whereNull('borrowedDate');

						})
						->orWhere(function($query2) {
							$query2->whereNotNull('borrowedDate')
								   ->whereNull('returnedDate');
						});
					})->count();
		// SELECT count(*) FROM `transactions` WHERE `borrower_id` = 2 
		// 	AND `book_id` = 2 AND (
		// 		(
		// 			`reservedDate` IS NOT NULL 
		// 			and `borrowedDate` IS NULL
		// 		) 
		// 		OR (
		// 			`borrowedDate` IS NOT NULL 
		// 			AND `returnedDate` IS NULL
		// 		)
		// 	)
		if($checkTransaction > 0) {
			return 0;
		} else {
			$transaction = new Transaction;
			$transaction->borrower_id = $borrowerId;
			$transaction->book_id = $bookId;
			$transaction->reservedDate = date("Y-m-d H:i:s", time());
			$transaction->save();
			return 1;
		}
	}
});

Route::get('test', function() {
	return View::make('users.transaction');
});