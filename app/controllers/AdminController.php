<?php

class AdminController extends BaseController {

	//home
	public function index()
	{
		return View::make('admin.index');
	}

	// display all books
	public function books()
	{
		$books =  Book::all();

		return View::make('admin.books')->with('books',$books);
	}

	// add books
	public function addBooks()
	{
		return View::make('admin.addBooks');
	}

	//create books
	public function createBooks()
	{
		$input = Input::all();

		$books = new Book;

		$books->ISBN = $input['isbn'];
		$books->title = $input['title'];
		$books->author = $input['author'];
		$books->description = $input['description'];
		$books->category = $input['category'];
		$books->quantity = $input['quantity'];

		$books->save();

		return Redirect::to('books');
	}

	//edit books
	public function editBooks()
	{

		return View::make('admin.editBooks');
	}

	//delete books
	public function deleteBooks($id)
	{

		$books = Book::find($id);

		$books->delete();

		return Redirect::to('books');
	}

	//borrow index
	public function borrow(){

		return View::make('admin.borrow');
	}

	//borrower search
	public function search(){

		$input = Input::get('borrowerId');

		$result = DB::table('borrowers')
            ->where('borrower_code', '=', 12)
            ->get();

        return View::make('admin.sample')->with('result', $result);
	}
}
