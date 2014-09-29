<?php

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
        	->withInput();
	}

	public function logout(){
		Auth::logout();
		return Redirect::route('home');
	}

	public function profile(){
		return View::make('users.profile');
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
	    	$user = new User;
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->previlage = 1;
			$user->save();

			$borrower = new Borrower;
			$borrower->borrower_code = Input::get('borrower_code');
			$borrower->first_name = Input::get('first_name');
			$borrower->last_name = Input::get('last_name');
			$borrower->user_id = $user->id;

			$borrower->save();

			return Redirect::route('login')
						->with('flash_error', 'You are successfully registered.');
	    } else {
	    	return Redirect::back()->withInput()->withErrors($validation)->with('flash_error', 'Validation Errors!');
	    }
	}

	public function resultSearchData(){
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
	        
	        //return $book_result;
			return Response::json(['book_result'=>$book_result, 'book_count'=>$book_count]);
		}
	}
}
