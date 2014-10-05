<?php

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

		$image = Input::file('image');
		if($image) {
			$filename = $image->getClientOriginalName();        
			$destination = 'public/img/upload';      
			$image->move($destination, $filename);
			$file = strtolower($filename);
		}       
		
		if($validation->passes()) {
			$books = new Book;

			$books->ISBN = Input::get('ISBN');
			$books->title = Input::get('title');
			$books->author = Input::get('author');
			$books->description = Input::get('description');
			if($image) $books->image = $file;
			$books->category = Input::get('category');
			$books->quantity = Input::get('quantity');

			$books->save();

			return Redirect::to('books');
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

	    $books->ISBN = Input::get('ISBN');
		$books->title = Input::get('title');
		$books->author = Input::get('author');
		$books->description = Input::get('description');
		$books->category = Input::get('category');
		$books->quantity = Input::get('quantity');

		$books->save();

		return Redirect::to('books');
    }
    //delete books
    public function deleteBooks($id)
    {
    	$books = Book::find($id);
    	$books->delete();
    	return Redirect::to('books');
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

			return Redirect::to('borrowers');
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

			return Redirect::to('borrowers');
		} else{
			return Redirect::back()->withInput()->withErrors($validation)->with('flash_error', 'Errors!');
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

		$borrowers->save();

		return Redirect::to('borrowers');
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

		return Redirect::to('borrowers');
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
    	return Redirect::to('borrowers');
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
			$transaction->borrowedDate = date("Y-m-d H:i:s", time());
			$transaction->save();
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
			$transaction = Transaction::find(Input::get('transaction_id'));
			$transaction->returnedDate = date("Y-m-d H:i:s", time());
			$transaction->save();
		}
	}  
}
