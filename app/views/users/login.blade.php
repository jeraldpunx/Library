@extends('layout')

@section('content')
	{{ Form::open(['action'=>'login', 'method'=>'POST']) }}
		<div>
			{{ Form::label('username', 'Username :') }}
			{{ Form::text('username') }}
		</div>
		<div>
			{{ Form::label('password', 'Password :') }}
			{{ Form::password('password') }}
		</div>
		<div>
			{{ Form::submit('Login') }}
			{{ link_to('register', 'Register') }}
		</div>
	{{ Form::close() }}
@endsection