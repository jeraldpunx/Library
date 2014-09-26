<?php

class UsersController extends \BaseController {

	public function showLogin()
	{
		return View::make('users.login');
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
        return Redirect::route('login')->withInput();
	}

	public function logout(){
		Auth::logout();
		return Redirect::route('/');
	}

	public function profile(){
		return View::make('profile');
	}

	public function create()
	{
		return View::make('users.register');
	}

	public function store()
	{

	}
}
