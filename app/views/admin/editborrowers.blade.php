@extends('layout')

@section('title')
    {{$companyName}} | Edit Borrower
@endsection

@section('content')
    @include('include.nav')
    
    <div class="container">
        <h4><i class="fa fa-user"></i>Manage Borrowers</h4>
        <div class="hr"><hr /></div><br><br>
        <div class="col-md-7">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"<i class="fa fa-user"></i> Manage Borrowers</h3>
                </div>
                <div class="panel-body">
                    {{ Form::model($borrower, ['route' => ['borrowers/update', $borrower[0]->borrower_id ],'method' => 'put']) }}
                    
                        <div class="form-group">
                            <p>Borrower Code:</p>
                            {{ Form::text('borrower_code', $borrower[0]->borrower_code, ['class'=>'form-control', 'placeholder'=>'Enter your Student ID', 'required'=>'', 'autofocus'=>'']) }}
                        </div>

                        <div class="form-group">
                            <p>First Name:</p>
                            {{ Form::text('first_name', $borrower[0]->first_name, ['class'=>'form-control', 'placeholder'=>'Firstname', 'required'=>'', 'autofocus'=>'']) }}
                        </div>

                        <div class="form-group">
                            <p>Last Name:</p>
                            {{ Form::text('last_name', $borrower[0]->last_name, ['class'=>'form-control', 'placeholder'=>'Lastname', 'required'=>'', 'autofocus'=>'']) }}
                        </div>

                        <div class="form-group">
                            <p>Penalty:</p>
                            {{ Form::text('penalty', $borrower[0]->penalty, ['class'=>'form-control', 'placeholder'=>'Penalty', 'required'=>'', 'autofocus'=>'']) }}
                        </div>
                    
                        {{ Form::submit('Save Changes', ['class'=>'btn btn-primary btn-lg btn-block']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-5">
            @if($borrower[0]->user_id)
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Manage Account</h3>
                </div>
                <div class="panel-body">
                    {{ Form::model($borrower, ['route' => ['users/update', $borrower[0]->user_id],'method' => 'put']) }}
                        <div class="form-group">
                            <p>Username:</p>
                            {{ Form::text('username', $borrower[0]->username, ['class'=>'form-control', 'placeholder'=>'Enter your username', 'autofocus'=>'']) }}
                        </div>
                        <div class="form-group">
                            <p>Password:</p>
                            {{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) }}
                        </div>
                        <div class="form-group">
                            <p>Previlage:  0 - Admin/1 - User</p>
                            {{ Form::text('previlage', $borrower[0]->previlage, array('class' => 'form-control','placeholder'=>'Previlage: 0 - Admin/1 - User')) }}
                        </div>
                        
                        {{ Form::submit('Save Changes', ['class'=>'btn btn-primary btn-lg btn-block']) }}
                    {{Form::close()}}
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
@section('script')
<script>
    $(function() {
        @if(Session::has('flash_error'))
            notif({
              type: "success",
              msg: "{{ Session::get('flash_error') }}",
              bgcolor: "{{ Session::get('flash_color') }}",
              multiline: true
            });
        @endif
    });
</script> 
@endsection