@extends('layout')

@section('content')
	<div class="login-screen">
		<div class="login-icon">
			<h4>Welcome to</h4>
			{{ HTML::image('img/Book@2x.png') }}
			<h3>{{ $companyName }}</h3>
		</div>

		{{ Form::open(['action'=>'login', 'method'=>'POST', 'class'=>'login-form']) }}
			<div class="form-group">
				{{ Form::text('username', '', ['class'=>'form-control login-field', 'placeholder'=>'Enter your username', 'required'=>'', 'autofocus'=>'']) }}
				<label class="login-field-icon fui-user" for="login-name"></label>
			</div>

			<div class="form-group">
				{{ Form::password('password', ['class'=>'form-control login-field', 'placeholder'=>'Password', 'required'=>'']) }}
				<label class="login-field-icon fui-lock" for="login-pass"></label>
			</div>
			
			{{ Form::submit('Login', ['class'=>'btn btn-primary btn-lg btn-block']) }}
			<a class="btn btn-warning btn-lg btn-block" href="register">Register</a>
			<a class="login-link" href="{{ URL::route('home') }}"><i class="fui-arrow-left"></i>Main Page</a>
		{{ Form::close() }}
	</div>


@endsection

@section('script')
<script>
	$(function() {
		@if(Session::has('flash_error'))
			notif({
			  msg: "{{Session::get('flash_error')}}",
			  type: "success",
			  bgcolor: "#c0392b"
			});
		@endif
	});
</script> 
@endsection