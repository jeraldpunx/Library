@extends('layout')

@section('title')
    {{$companyName}} | Add Borrower
@endsection

@section('content')
    @include('include.nav')

    {{ Form::open(array('url'=>'borrowers/create')) }}
    <div class="container">
        <h4><i class="fa fa-user"></i>Add Borrowers</h4>
        <div class="hr"><hr /></div><br><br>
            <div class="col-md-13">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><i class="fa fa-user"></i> Add Borrower </strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                {{ Form::label('borrower_code', 'Borrower Code', array('class' => 'col-sm-2 control-label')) }}
                                <div class="col-sm-8">
                                    {{ Form::text('borrower_code','', array('class' => 'form-control','placeholder'=>'Borrwer Code')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('first_name', 'First Name', array('class' => 'col-sm-2 control-label')) }}
                                <div class="col-sm-8">
                                    {{ Form::text('first_name','', array('class' => 'form-control','placeholder'=>'First Name')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('last_name', 'Last Name', array('class' => 'col-sm-2 control-label')) }}
                                <div class="col-sm-8">
                                    {{ Form::text('last_name','', array('class' => 'form-control','placeholder'=>'Last Name')) }}
                                </div>
                            </div>
                        </div>  
                        <div style="margin-left: 780px;">
                            {{ Form::submit('+ Add Borrowers',['class="btn btn-primary"']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
    <?php $msg = ""; ?>
    @foreach ($errors->all('<li>:message</li>') as $message)
        <?php $msg = $msg . $message; ?>
    @endforeach
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