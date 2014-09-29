@extends('layout')

@section('content')
	<div class="login-screen">
		<div class="login-icon">
			<h4>Welcome to</h4>
			{{ HTML::image('img/Book@2x.png') }}
			<h3>{{ $companyName }}</h3>
		</div>

		{{ Form::open((['action'=>'register', 'method'=>'POST', 'class'=>'login-form'])) }}
			<div class="form-group">
				{{ Form::text('username', '', ['class'=>'form-control login-field', 'placeholder'=>'Enter your username', 'required'=>'', 'autofocus'=>'']) }}
				<label class="login-field-icon fui-user" for="login-name"></label>
			</div>

			<div class="form-group">
				{{ Form::password('password', ['class'=>'form-control login-field', 'placeholder'=>'Password', 'required'=>'']) }}
				<label class="login-field-icon fui-lock" for="login-pass"></label>
			</div>

			<div class="form-group">
				{{ Form::password('password_confirmation', ['class'=>'form-control login-field', 'placeholder'=>'Confirm Password', 'required'=>'']) }}
				<label class="login-field-icon fui-lock" for="login-pass"></label>
			</div>

			<div class="form-group">
				{{ Form::text('borrower_code', '', ['class'=>'form-control login-field', 'placeholder'=>'Enter your Student ID', 'required'=>'', 'autofocus'=>'']) }}
				<label class="login-field-icon fui-user" for="login-name"></label>
			</div>

			<div class="form-group">
				{{ Form::text('first_name', '', ['class'=>'form-control login-field', 'placeholder'=>'Firstname', 'required'=>'', 'autofocus'=>'']) }}
				<label class="login-field-icon fui-user" for="login-name"></label>
			</div>

			<div class="form-group">
				{{ Form::text('last_name', '', ['class'=>'form-control login-field', 'placeholder'=>'Lastname', 'required'=>'', 'autofocus'=>'']) }}
				<label class="login-field-icon fui-user" for="login-name"></label>
			</div>
		
			{{ Form::submit('Register', ['class'=>'btn btn-warning btn-lg btn-block']) }}
			<a class="login-link" href="{{ URL::route('home') }}"><i class="fui-arrow-left"></i>Main Page</a>
		{{ Form::close() }}
		
		<?php $msg = ""; ?>
		@foreach ($errors->all('<li>:message</li>') as $message)
		    <?php $msg = $msg . $message; ?>
		@endforeach
	</div>
@endsection

@section('script')
<script>
	$(function() {
		@if(Session::has('flash_error'))
			notif({
			  type: "success",
			  msg: "<ul>{{ $msg }}</ul>",
			  bgcolor: "#c0392b",
			  multiline: true
			});
		@endif
	});
</script> 
@endsection