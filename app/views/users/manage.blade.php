@extends('layout')

@section('content')
    @include('include.nav')
	<div class="container">
		<div class="col-md-7">
			<div class="panel panel-primary">
	            <div class="panel-heading">
	            	<h3 class="panel-title">Manage Profile</h3>
				</div>
	            <div class="panel-body">
					{{ Form::open((['action'=>'register', 'method'=>'POST', 'class'=>''])) }}
						
						<div class="form-group">
							<p>Username:</p>
							{{ Form::text('username', '', ['class'=>'form-control', 'placeholder'=>'Enter your username', 'required'=>'', 'autofocus'=>'']) }}
						</div>
						
						<div class="form-group">
							<p>Borrower Code:</p>
							{{ Form::text('borrower_code', '', ['class'=>'form-control', 'placeholder'=>'Enter your Student ID', 'required'=>'', 'autofocus'=>'']) }}
						</div>

						<div class="form-group">
							<p>First Name:</p>
							{{ Form::text('first_name', '', ['class'=>'form-control', 'placeholder'=>'Firstname', 'required'=>'', 'autofocus'=>'']) }}
						</div>

						<div class="form-group">
							<p>Last Name:</p>
							{{ Form::text('last_name', '', ['class'=>'form-control', 'placeholder'=>'Lastname', 'required'=>'', 'autofocus'=>'']) }}
						</div>
					
						{{ Form::submit('Save Changes', ['class'=>'btn btn-primary btn-lg btn-block']) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="panel panel-primary">
	            <div class="panel-heading">
	            	<h3 class="panel-title">Change Password</h3>
				</div>
	            <div class="panel-body">
					{{ Form::open((['action'=>'register', 'method'=>'POST', 'class'=>''])) }}
						<div class="form-group">
							<p>Old Password:</p>
							{{ Form::password('oldPassword', ['class'=>'form-control', 'placeholder'=>'Old Password', 'required'=>'']) }}
						</div>
						<div class="form-group">
							<p>New Password:</p>
							{{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'New Password', 'required'=>'']) }}

						</div>
						<div class="form-group">
							{{ Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'Retype New Password', 'required'=>'']) }}
						</div>

						{{ Form::submit('Change Password', ['class'=>'btn btn-primary btn-lg btn-block']) }}
					{{Form::close()}}
				</div>
			</div>
		</div>
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