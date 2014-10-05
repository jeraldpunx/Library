@extends('layout')

@section('content')
    @include('include.nav')

    <div class="container">
        <h4 style="margin-left: 14px;">All Borrowers</h4>
        <div class="hr"><hr /></div><br><br>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Borrowers </strong></h3>
                </div>
                <div class="panel-body">
                    {{ link_to('borrowers/add', '+ Add Borrowers',['class="btn btn-primary"']) }}
                    <br><br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><center>Borrower Code</center></th>
                                <th><center>Name</center></th>
                                <th><center>Penalty</center></th>
                                <th><center>Username</center></th>
                                <th><center>Manage</center></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($borrowers as $borrower)
                            <tr>
                                <td><center>{{ $borrower->borrower_code }}</center></td>
                                <td><center>{{ $borrower->first_name . ' ' . $borrower->last_name }}</center></td>
                                <td><center>{{ $borrower->penalty }}</center>
                                </td>

                                <td>
                                    <center>
                                    @if($borrower->username)
                                        {{ $borrower->username; }}
                                    @else
                                        {{ link_to(''.$borrower->borrower_id,'Create account?',array('class'=>'btn btn-info btn-xs','data-toggle'=>'modal','data-target'=>'#create-user')) }}
                                    @endif
                                    </center>
                                </td>
                                <td class="text-center">{{ link_to('borrowers/'.$borrower->borrower_id.'/edit','Edit',array('class'=>'btn btn-primary btn-xs')) }}
                                {{ link_to(''.$borrower->borrower_id,'Del',array('class'=>'btn btn-danger btn-xs','data-toggle'=>'modal','data-target'=>'#confirm-delete')) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div align ="right">
                        {{ $borrowers->links() }}   
                    </div>    
                </div>
            </div>
        </div>
        @if($borrowers)
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Are you sure you want to delete?</h4>
                    </div>
                    <div class="modal-body">
                        <dl class="dl-horizontal">
                          <dt>Borrower Code:</dt>
                          <dd>{{ $borrower->borrower_code }}</dd>
                          <dt>Name:</dt>
                          <dd>{{ $borrower->first_name . ' ' . $borrower->last_name }}</dd>
                          <dt>Username:</dt>
                          <dd>{{ $borrower->username }}</dd>
                        </dl>
                    </div>
                    <div class="modal-footer">
                            <?php $id = $borrower->borrower_id; ?>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <a href="{{ URL::route('borrowers/delete', $id) }}" class="btn btn-danger danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        
        {{ Form::open(array('url'=>'users/create')) }}
        <div class="modal fade" id="create-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Create "{{ $borrower->borrower_code }}" account?</h4>
                    </div>
                    <div class="modal-body">
                        <dl class="dl-horizontal">
                          <dt>Borrower Code:</dt>
                          <dd>{{ $borrower->borrower_code }}</dd>
                          <dt>Name:</dt>
                          <dd>{{ $borrower->first_name . ' ' . $borrower->last_name }}</dd>
                          <dd>{{ Form::hidden('borrower_id', $borrower->borrower_id) }}<br></dd>
                          <dt>Username:</dt>
                          <dd>{{ Form::text('username','', array('class'=>'form-control', 'placeholder'=>'Username')) }}</dd>
                          <dt>Password:</dt>
                          <dd>{{ Form::password('password', ['class'=>'form-control', 'required'=>'']) }}
                          </dd>
                          <dt>Confirm Password:</dt>
                          <dd>{{ Form::password('password_confirmation', ['class'=>'form-control', 'required'=>'']) }}
                          </dd>
                        </dl>
                    </div>
                    <div class="modal-footer">
                            {{ Form::submit('+ Add User',['class="btn btn-primary"']) }}
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
        @endif
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('html'));
        });
    </script>
@endsection