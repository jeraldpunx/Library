<?php
date_default_timezone_set('Asia/Manila');
class AdminController extends BaseController {
	public function books()
	{
		$books =  Book::paginate(5);

		return View::make('admin.books')->with('books',$books);
	}
	//add books

	public function addBooks()
	{
		return View::make('admin.addbooks');
	}
	//create books
	public function createBooks()
	{
		$input = Input::all();

	    $rules = array(
	        'ISBN' => 'required|unique:books,ISBN',
			'title' => 'required',
			'author' => 'required',
			'description' => 'required',
			'category' => 'required',
			'quantity' => 'required'
	    );

	    $custom_error = array(
	    	'ISBN.unique' => 'The ISBN was already been taken.',
	    	'ISBN.required' => 'The ISBN field is required.'
	    );

	    $validation = Validator::make($input, $rules, $custom_error);
		
		if($validation->passes()) {
			$image = Input::file('image');
			if($image) {
				$upload_folder = '/img/upload/';
				$file_name = str_random(30). '.' . $image->getClientOriginalExtension();
				$image->move(public_path() . $upload_folder, $file_name);
			}

			$books = new Book;

			$books->ISBN = Input::get('ISBN');
			$books->title = Input::get('title');
			$books->author = Input::get('author');
			$books->description = Input::get('description');
			if($image) $books->image = $file_name;
			$books->category = Input::get('category');
			$books->quantity = Input::get('quantity');

			$books->save();

			return Redirect::to('books')
					->with('flash_error', 'Successfully created.')
        			->with('flash_color', '#27ae60');
		} else{
			return Redirect::back()->withInput()->withErrors($validation)->with('flash_error', 'Errors!');
		}
	}
	//edit books
	public function editBooks($id)
	{
		$books = Book::find($id);
        if (is_null($books))
        	return Redirect::to('books');

		return View::make('admin.editbooks')->with('books', $books);
	}
	//update books
	public function updateBooks($id)
	{
		$input = Input::all();

	    $books = Book::find($id);

	    $image = Input::file('image');
	    if($image) {
	    	$upload_folder = '/img/upload/';
	    	$file_name = str_random(30). '.' . $image->getClientOriginalExtension();
	    	$image->move(public_path() . $upload_folder, $file_name);
	    }

	    $books->ISBN = Input::get('ISBN');
		$books->title = Input::get('title');
		$books->author = Input::get('author');
		$books->description = Input::get('description');
		if($image) $books->image = $file_name;
		$books->category = Input::get('category');
		$books->quantity = Input::get('quantity');

		$books->save();

		return Redirect::to('books')
				->with('flash_error', 'Successfully updated.')
        		->with('flash_color', '#27ae60');
    }
    //delete books
    public function deleteBooks($id)
    {
    	$books = Book::find($id);
    	$books->delete();
    	return Redirect::to('books')
    			->with('flash_error', 'Successfully deleted.')
        		->with('flash_color', '#27ae60');
    }
    public function borrowers()
	{
		//SELECT * FROM borrowers LEFT JOIN users ON users.borrower_id = borrowers.id 
		//$borrowers =  Borrower::paginate(5);
		$borrowers = DB::table('borrowers')
					->SELECT(['borrowers.id as borrower_id', 'borrower_code','first_name', 'last_name', 'penalty', 'users.id as user_id', 'username'])
					->leftJoin('users', 'users.borrower_id', '=', 'borrowers.id')
					->paginate(5);
		return View::make('admin.borrowers')->with('borrowers',$borrowers);
	}
	//add borrowers
	public function addBorrowers()
	{
		return View::make('admin.addborrowers');
	}
	//create borrowers
	public function createBorrowers()
	{
		$input = Input::all();

	    $rules = array(
	        'borrower_code' => 'required|unique:borrowers,borrower_code',
			'first_name' => 'required',
			'last_name' => 'required'
	    );

	    $custom_error = array(
	    	'borrower_code.unique' => 'The Student ID was already been taken.'
	    );

	    $validation = Validator::make($input, $rules, $custom_error);
		
		if($validation->passes()) {
			$borrower = new Borrower;
			$borrower->borrower_code = Input::get('borrower_code');
			$borrower->first_name = Input::get('first_name');
			$borrower->last_name = Input::get('last_name');
			$borrower->penalty = 0;
			$borrower->save();

			return Redirect::to('borrowers')
					->with('flash_error', 'Successfully created.')
        			->with('flash_color', '#27ae60');
		} else{
			return Redirect::back()->withInput()->withErrors($validation)->with('flash_error', 'Errors!');
		}
	}
	//create users
	public function createUsers()
	{
		$input = Input::all();

	    $rules = array(
	        'username' => 'required|min:5|unique:users,username',
			'password' => 'required|confirmed',
			'password_confirmation' => 'same:password'
	    );

	    $validation = Validator::make($input, $rules);
		
		if($validation->passes()) {
			$users = new User;

			$users->username = Input::get('username');
			$users->password = Hash::make(Input::get('password'));
			$users->borrower_id = Input::get('borrower_id');
			$users->save();

			return Redirect::to('borrowers')
				->with('flash_error', 'Successfully created.')
        		->with('flash_color', '#27ae60');
		} else{
			return Redirect::back()
					->with('flash_error', 'Failed to create Account.')
		        	->with('flash_color', '#c0392b')
		        	->withInput();
		}
	}
	//edit borrowers
	public function editBorrowers($id)
	{
		$borrower = Borrower::find($id);
        if (is_null($borrower))
        	return Redirect::to('Borrowers');

        $borrower = DB::table('borrowers')
					->SELECT(['borrowers.id as borrower_id', 'borrower_code','first_name', 'last_name', 'penalty', 'users.id as user_id', 'username', 'previlage'])
					->leftJoin('users', 'users.borrower_id', '=', 'borrowers.id')
					->Where('borrowers.id', '=', $borrower->id)
					->get();
		return View::make('admin.editborrowers')->with('borrower', $borrower);
	}
	//update borrowers
	public function updateBorrowers($id)
	{
	    $borrowers = Borrower::find($id);

	    $borrowers->borrower_code = Input::get('borrower_code');
		$borrowers->first_name = Input::get('first_name');
		$borrowers->last_name = Input::get('last_name');
		$borrowers->penalty = Input::get('penalty');

		$borrowers->save();

		return Redirect::to('borrowers')
				->with('flash_error', 'Successfully updated.')
        		->with('flash_color', '#27ae60');
    }
    public function updateUsers($id)
    {
    	$input = Input::all();

	    $users = User::find($id);

	    $users->username = Input::get('username');
	    if(Input::get('password'))
			$users->password = Hash::make(Input::get('password'));
		$users->previlage = Input::get('previlage');

		$users->save();

		return Redirect::to('borrowers')
				->with('flash_error', 'Successfully updated.')
        		->with('flash_color', '#27ae60');
    }
    //delete borrowers
    public function deleteBorrowers($id)
    {
    	$borrower = Borrower::find($id);
    	$borrower = DB::table('borrowers')
					->SELECT(['borrowers.id as borrower_id', 'borrower_code','first_name', 'last_name', 'penalty', 'users.id as user_id', 'username', 'previlage'])
					->leftJoin('users', 'users.borrower_id', '=', 'borrowers.id')
					->Where('borrowers.id', '=', $borrower->id)
					->get();
		
		if($borrower[0]->user_id) {
			$user = User::find($borrower[0]->user_id);
			$user->delete();
		}
		$borrower = Borrower::find($borrower[0]->borrower_id);
    	$borrower->delete();
    	return Redirect::to('borrowers')
    			->with('flash_error', 'Successfully deleted.')
        		->with('flash_color', '#27ae60');
    }
	

	//TRANSACTION
	public function adminHistory() 
	{
		$histories = DB::table('transactions')
	        				->leftJoin('books', 'transactions.book_id', '=', 'books.id')
	        				->leftJoin('borrowers', 'transactions.borrower_id', '=', 'borrowers.id')
	        				->whereNotNull('borrowedDate')
	        				->whereNotNull('returnedDate')
				            ->get();
		return View::make('admin.history')->with('histories', $histories);
	}

	public function adminRequest() 
	{
		DB::table('notifications')->delete();
		$requests = DB::table('transactions')
						->join('books', 'transactions.book_id', '=', 'books.id')
	        			->join('borrowers', 'transactions.borrower_id', '=', 'borrowers.id')
	        			->select('transactions.id as transaction_id', 
	        					'books.ISBN', 'books.title', 'books.author',
	        					'transactions.reservedDate', 'borrowers.borrower_code', 
	        					'borrowers.first_name', 'borrowers.last_name')
	        			->whereNotNull('reservedDate')
						->whereNull('borrowedDate')
	        			->whereNull('returnedDate')
	        			->orderBy('reservedDate', 'desc')
						->get();
		return View::make('admin.request')->with('requests', $requests);
	}

	public function approveRequest() 
	{
		if (Request::ajax()) {
			$transaction = Transaction::find(Input::get('transaction_id'));
			$book = DB::table('books')
					->Where('id', '=', $transaction['book_id'])
					->get();
			$bookQuantity = $book[0]->quantity;
			if($bookQuantity > 0) {
				$transaction->borrowedDate = date("Y-m-d H:i:s", time());
				$transaction->save();
				DB::table('books')
						->Where('id', '=', $transaction['book_id'])
						->decrement('quantity');
			} else {
				return false;
			}
		}
	}

	public function adminUnreturn() 
	{
		$unreturns = DB::table('transactions')
						->join('books', 'transactions.book_id', '=', 'books.id')
	        			->join('borrowers', 'transactions.borrower_id', '=', 'borrowers.id')
	        			->select('transactions.id as transaction_id', 
	        					'books.ISBN', 'books.title', 'books.author',
	        					'transactions.borrowedDate', 'borrowers.borrower_code', 
	        					'borrowers.first_name', 'borrowers.last_name')
	        			->whereNotNull('borrowedDate')
	        			->whereNull('returnedDate')
				        ->get();
		return View::make('admin.unreturn')->with('unreturns', $unreturns);
	}

	public function returnBook() 
	{
		if (Request::ajax()) {
			$result = DB::table('transactions')
					->Where('id', '=', Input::get('transaction_id'))
					->get();
			$borrowedDate = strtotime($result[0]->borrowedDate);
			$current_date = strtotime(date("Y-m-d H:i:s", time()));
			$datediff = floor(($current_date - $borrowedDate)/(60*60*24));

			if($datediff >= Borrower::$daysExpired) {
				$totalPenalty = (($datediff + 1) - Borrower::$daysExpired) * Borrower::$perDayPenalty;
				DB::table('borrowers')
						->Where('id', '=', $result[0]->borrower_id)
						->increment('penalty', $totalPenalty);
			}
			DB::table('books')
					->Where('id', '=', $result[0]->book_id)
					->increment('quantity');
			$transaction = Transaction::find(Input::get('transaction_id'));
			$transaction->returnedDate = date("Y-m-d H:i:s", time());
			$transaction->save();
		}
	} 

	//ISSUE BOOK
	public function issueBook()
	{
		return View::make('admin.issue');
	}

	public function searchBorrowersCode()
	{
		$search = Input::get('borrower_code');
		$results = DB::table('borrowers')
				->Where('borrower_code', 'LIKE','%'.$search.'%')
				->get();
		$data = array();
		foreach($results as $result)
			array_push($data, $result->borrower_code);
		
		return json_encode($data);
	}

	public function resultBorrowerCode()
	{
		$search = Input::get('result_borrower_code');
		$results = DB::table('borrowers')
				->Where('borrower_code', '=', $search)
				->get();
		return $results;
	}

	public function searchISBN()
	{
		$search = Input::get('ISBN');
		$results = DB::table('books')
				->Where('ISBN', 'LIKE','%'.$search.'%')
				->get();
		$data = array();
		foreach($results as $result)
			array_push($data, $result->ISBN);
		
		return json_encode($data);
	}

	public function resultISBN()
	{
		$search = Input::get('result_ISBN');
		$results = DB::table('books')
				->Where('ISBN', '=', $search)
				->get();
		return $results;
	}

	public function storeIssueBook()
	{
		$input = Input::all();

	    $rules = array(
			'book_id' => 'required',
			'borrower_id' => 'required'
	    );

	    $validation = Validator::make($input, $rules);

	    if($validation->passes()) {
	    	$penalty = DB::table('borrowers')
						->Where('id', '=', Input::get('borrower_id'))
						->Where('penalty', '>', 0)
						->count();
			$borrowedBook = DB::table('transactions')
						->Where('borrower_id', '=', Input::get('borrower_id'))
						->Where('book_id', '=', Input::get('book_id'))
						->whereNotNull('borrowedDate')
						->whereNull('returnedDate')
						->count();
			$book = DB::table('books')
					->Where('id', '=', Input::get('book_id'))
					->get();
			$bookQuantity = $book[0]->quantity;
			if($bookQuantity <= 0) {
				return Redirect::back()
				   	->with('flash_error', "No more available books.");
			}
			if($penalty > 0) {
				return Redirect::back()
				   	->with('flash_error', "He/She still have penalty!");
			} else if($borrowedBook > 0) {
				return Redirect::back()
				   	->with('flash_error', "He/She still borrowing this Book!");
			}
	    	$transaction = new Transaction;
			$transaction->borrower_id = Input::get('borrower_id');
			$transaction->book_id = Input::get('book_id');
			$transaction->borrowedDate = date("Y-m-d H:i:s", time());
			$transaction->save();
			DB::table('books')
					->Where('id', '=', Input::get('book_id'))
					->decrement('quantity');

			return Redirect::route('adminUnreturn')
						->with('flash_error', 'Successfully Book Issued.');
	    } else {
	    	return Redirect::back()
		    	->withInput()
		    	->withErrors($validation)
		    	->with('flash_error', 'Validation Errors!');
	    }
	}



	public function requestNotifications(){

		DB::table('notifications')->delete();

		return  Redirect::to('adminRequest');

	}

	public function viewBorrowerHistory($id)
	{
		$borrowerHistory = DB::table('transactions')
	        				->leftJoin('books', 'transactions.book_id', '=', 'books.id')
	        				->leftJoin('borrowers', 'transactions.borrower_id', '=', 'borrowers.id')
	        				->where('borrower_id', '=',  $id)
	        				->whereNotNull('borrowedDate')
	        				->whereNotNull('returnedDate')
				            ->get();
		$borrowers = DB::table('borrowers')
					->Where('id', '=', $id)
					->get();


		return View::make('admin.viewborrowerhistory')
				->with('borrowerHistory', $borrowerHistory)
				->with('borrowers', $borrowers);
	}

	public function viewBorrowerRequest($id)
	{
		$borrowerRequest = DB::table('transactions')
						->join('books', 'transactions.book_id', '=', 'books.id')
	        			->join('borrowers', 'transactions.borrower_id', '=', 'borrowers.id')
	        			->where('borrower_id',$id)
	        			->whereNotNull('reservedDate')
						->whereNull('borrowedDate')
	        			->whereNull('returnedDate')
	        			->orderBy('reservedDate', 'desc')
						->get();

		$borrowers = DB::table('borrowers')
					->Where('id', '=', $id)
					->get();
					
		return View::make('admin.viewborrowerrequest')
				->with('borrowerRequest', $borrowerRequest)
				->with('borrowers', $borrowers);
	}
	public function viewBorrowerUnreturn($id)
	{
		$borrowerUnreturn = DB::table('transactions')
						->join('books', 'transactions.book_id', '=', 'books.id')
	        			->join('borrowers', 'transactions.borrower_id', '=', 'borrowers.id')
	      				->where('borrower_id',$id)
	        			->whereNotNull('borrowedDate')
	        			->whereNull('returnedDate')
				        ->get();

		$borrowers = DB::table('borrowers')
					->Where('id', '=', $id)
					->get();

		return View::make('admin.viewborrowerunreturn')
					->with('borrowerUnreturn', $borrowerUnreturn)
					->with('borrowers', $borrowers);
	}
}
