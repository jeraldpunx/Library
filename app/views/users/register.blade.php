@extends('layout')

@section('content')
	{{ Form::open(['url'=>'register']) }}
		<div>
			{{ Form::label('username', 'Username :') }}
			{{ Form::text('username','',array('placeholder'=>'Username')) }}
			{{ $errors->first('username') }}
		</div>
		<div>
			{{ Form::label('password', 'Password :') }}
			{{ Form::password('password') }}
			{{ $errors->first('password') }}
		</div>
		<div>
			{{ Form::label('password_confirmation', 'Retype password :') }}
			{{ Form::password('password_confirmation') }}
			{{ $errors->first('password_confirmation') }}
		</div>
		<div>
			{{ Form::label('userfname', 'First name :') }}
			{{ Form::text('userfname','',array('placeholder'=>'First name')) }}
			{{ $errors->first('userfname') }}
		</div>
		<div>
			{{ Form::label('userlname', 'Last name :') }}
			{{ Form::text('userlname','',array('placeholder'=>'Last name')) }}
			{{ $errors->first('userlname') }}
		</div>
		<div>
			{{ Form::submit('Register') }}
			{{ Form::reset('Clear') }}
		</div>
	{{ Form::close() }}
@endsection