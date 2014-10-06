<?php
date_default_timezone_set('Asia/Manila');
class UsersController extends \BaseController {

	public function showLogin()
	{
		return View::make('login');
	}

	public function doLogin()
	{
		$user = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );
        
        if (Auth::attempt($user)) {
            return Redirect::route('home');
        }
        
        // authentication failure! lets go back to the login page
        return Redirect::route('login')
        	->with('flash_error', 'Your username/password combination was incorrect.')
        	->with('flash_color', '#c0392b')
        	->withInput();
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::route('home');
	}

	public function manageProfile()
	{
		$borrower = DB::table('borrowers')
					->leftJoin('users', 'users.borrower_id', '=', 'borrowers.id')
					->where('borrower_id', '=', Auth::user()->borrower_id)
					->get();
		return View::make('users.manage')->with('borrower', $borrower);
	}

	public function changeProfile()
	{
		$user = Auth::user();
		$borrower = Borrower::find($user->borrower_id);
        $rules = array(
		    'username' => 'min:5|unique:users,username,'.$user->id,
		    'borrower_code' => 'unique:borrowers,borrower_code,'.$borrower->id
		);

		$validation = Validator::make(Input::all(), $rules);

		if($validation->passes()) {
			$user->username = Input::get('username');
			$user->save();

			$borrower->borrower_code = Input::get('borrower_code');
			$borrower->first_name = Input::get('first_name');
			$borrower->last_name = Input::get('last_name');
			$borrower->save();
		   	return Redirect::route('manageProfile')
        		->with('flash_error', 'Successfully changed.')
        		->with('flash_color', '#27ae60');
		} else {
		  	return Redirect::route('manageProfile')
        		->with('flash_error', 'Failed to change Profile Information.')
        		->with('flash_color', '#c0392b');
	    }
	}

	public function changePassword()
	{
		
        $user = Auth::user();
		if (!Hash::check(Input::get('oldPassword'), $user->password)) {
	        return Redirect::route('manageProfile')
        	->with('flash_error', 'Please specify the good current password.')
        	->with('flash_color', '#c0392b');
	    } else {
	    	$rules = array(
		        'password' => 'required|confirmed',
				'password_confirmation' => 'same:password',
		    );

		    $validation = Validator::make(Input::all(), $rules);

		    if($validation->passes()) {
		    	$user->password = Hash::make(Input::get('password'));
				$user->save();
		    	return Redirect::route('manageProfile')
        			->with('flash_error', 'Successfully changed password.')
        			->with('flash_color', '#27ae60');
		    } else {
		    	return Redirect::route('manageProfile')
        			->with('flash_error', 'Failed to change password.')
        			->with('flash_color', '#c0392b');
		    }
	    }
	}

	public function create()
	{
		return View::make('register');
	}

	public function store()
	{
		$input = Input::all();

	    $rules = array(
	        'username' => 'required|min:5|unique:users,username',
			'password' => 'required|confirmed',
			'password_confirmation' => 'same:password',
			'borrower_code' => 'required|unique:borrowers,borrower_code',
			'first_name' => 'required',
			'last_name' => 'required'
	    );

	    $custom_error = array(
	    	'borrower_code.unique' => 'The Student ID was already been taken. Ask Librarian to create your account.'
	    );

	    $validation = Validator::make($input, $rules, $custom_error);

	    if($validation->passes()) {
	    	$borrower = new Borrower;
			$borrower->borrower_code = Input::get('borrower_code');
			$borrower->first_name = Input::get('first_name');
			$borrower->last_name = Input::get('last_name');
			$borrower->penalty = 0;
			$borrower->save();

	    	$user = new User;
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->previlage = 1;
			$user->borrower_id = $borrower->id;
			$user->save();

			return Redirect::route('login')
						->with('flash_error', 'You have been successfully registered. Please sign-in to continue.')
						->with('flash_color', '#27ae60');
	    } else {
	    	return Redirect::back()
		    	->withInput()
		    	->withErrors($validation)
		    	->with('flash_error', 'Validation Errors!');
	    }
	}

	public function resultSearchData()
	{
		if(Request::ajax()) {
			$search = Input::get('search_field');
			$search_concept = Input::get('search_concept');
			$book_result = "";
			if($search_concept == 'All') {
				$book_result = DB::table('books') 
						->Where('ISBN', 'LIKE','%'.$search.'%')
	                    ->orWhere('title', 'LIKE','%'.$search.'%')
	                    ->orWhere('author', 'LIKE','%'.$search.'%')
	                    ->orWhere('category', 'LIKE','%'.$search.'%')
	                    ->orderBy('created_at', 'DESC')
	                    ->get();
	            $book_count = DB::table('books') 
						->Where('ISBN', 'LIKE','%'.$search.'%')
	                    ->orWhere('title', 'LIKE','%'.$search.'%')
	                    ->orWhere('author', 'LIKE','%'.$search.'%')
	                    ->orWhere('category', 'LIKE','%'.$search.'%')
	                    ->count();
	        } else if($search_concept == 'ISBN') {
				$book_result = DB::table('books')
						->Where('ISBN', 'LIKE','%'.$search.'%')
	                    ->orderBy('created_at', 'DESC')
	                    ->get();
	            $book_count = DB::table('books')
						->Where('ISBN', 'LIKE','%'.$search.'%')
						->count();
	        } else if($search_concept == 'Title') {
				$book_result = DB::table('books')
	                    ->Where('title', 'LIKE','%'.$search.'%')
	                    ->orderBy('created_at', 'DESC')
	                    ->get();
	            $book_count = DB::table('books')
	                    ->Where('title', 'LIKE','%'.$search.'%')
	                    ->count();
	        } else if($search_concept == 'Author') {
				$book_result = DB::table('books')
	                    ->Where('author', 'LIKE','%'.$search.'%')
	                    ->orderBy('created_at', 'DESC')
	                    ->get();
	            $book_count = DB::table('books')
	                    ->Where('author', 'LIKE','%'.$search.'%')
	                    ->count();
	        } else if($search_concept == 'Category') {
				$book_result = DB::table('books')
	                    ->Where('category', 'LIKE','%'.$search.'%')
	                    ->orderBy('created_at', 'DESC')
	                    ->get();
	            $book_count = DB::table('books')
	                    ->Where('category', 'LIKE','%'.$search.'%')
	                    ->count();
	        }
	        $count=0;
	        foreach ($book_result as $key => $value) {
	        	$description = $book_result[$count]->description;
	        	if(strlen($description) > 200) {
	        		$descriptionCut = substr($description, 0, 200);
	        		$book_result[$count]->description = substr($descriptionCut, 0, strrpos($descriptionCut, ' ')).'... <a href="/this/story">Read More</a>';
	        	}
	        	$count++;
	        }
			return Response::json(['book_result'=>$book_result, 'book_count'=>$book_count]);
		}
	}

	public function requestBookData() 
	{
		if(Request::ajax()) {
			$borrowerId = Input::get('borrowerId');
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
			$penalty = DB::table('borrowers')
						->Where('id', '=', $borrowerId)
						->Where('penalty', '>', 0)
						->count();
			if($checkTransaction > 0 || $penalty > 0) {
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
	}

	public function userHistory() 
	{
		$histories = DB::table('transactions')
	        				->leftJoin('books', 'transactions.book_id', '=', 'books.id')
	        				->Where('borrower_id', '=', Auth::user()->borrower_id)
	        				->whereNotNull('borrowedDate')
	        				->whereNotNull('returnedDate')
				            ->get();

		return View::make('users.history')->with('histories', $histories);
	}

	public function userRequest() 
	{
		$requests = DB::table('transactions')
						->join('books', 'transactions.book_id', '=', 'books.id')
	        			->select('transactions.id as transaction_id', 
	        					'books.ISBN', 
	        					'books.title',
	        					'books.author',
	        					'transactions.reservedDate')
	        			->Where('borrower_id', '=', Auth::user()->borrower_id)
						->whereNotNull('reservedDate')
						->whereNull('borrowedDate')
	        			->whereNull('returnedDate')
	        			->orderBy('reservedDate', 'desc')
						->get();
		return View::make('users.request')->with('requests', $requests);
	}

	public function deleteRequest() 
	{
		if (Request::ajax()) {
			Transaction::find(Input::get('transaction_id'))->delete();
		}
	}

	public function userUnreturn() 
	{
		$unreturns = DB::table('transactions')
	        				->leftJoin('books', 'transactions.book_id', '=', 'books.id')
	        				->Where('borrower_id', '=', Auth::user()->borrower_id)
	        				->whereNotNull('borrowedDate')
	        				->whereNull('returnedDate')
				            ->get();
		return View::make('users.unreturn')->with('unreturns', $unreturns);
	}
}
