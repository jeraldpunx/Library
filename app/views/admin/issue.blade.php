@extends('layout')

@section('content')
	<link rel="stylesheet" href="https://code.jquery.com/ui/jquery-ui-git.css" />
    @include('include.nav')
    
    <div class="container">
        <div class="panel panel-primary"> <!-- TYPE PANEL -->
            <div class="panel-heading"> <!-- HEAD PANEL -->
                <h4 class="panel-title"><i class="fa fa-bookmark"></i>  ISSUE A BOOK</h4>
            </div><!-- /HEAD PANEL -->
            <div class="panel-body"> <!-- CONTENT PANEL -->
            	<div class="col-md-6">
				{{ Form::open((['action'=>'issueBookPost', 'method'=>'POST'])) }}
					<div class="form-group">
						<label>Borrower ID</label>
						{{ Form::text('borrower_code', '', ['class'=>'form-control txt-auto', 'placeholder'=>'Enter your Borrower ID', 'autofocus'=>'', 'id'=>'borrower_code']) }}
					</div>
					<div class="form-group">
						<dl class="dl-horizontal">
						  {{ Form::hidden('borrower_id', '',['id'=>'borrower_id']) }}
                          <dt>Borrower Code:</dt>
                          <dd id="displayBorrowerCode"></dd>
                          <dt>Name:</dt>
                          <dd id="displayName"></dd>
                        </dl>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>ISBN</label>
						{{ Form::text('ISBN', '', ['class'=>'form-control txt-auto', 'placeholder'=>'Enter Book ISBN', 'autofocus'=>'', 'id'=>'ISBN']) }}
					</div>
					<div class="form-group">
						<dl class="dl-horizontal">
						  {{ Form::hidden('book_id', '',['id'=>'book_id']) }}
                          <dt>ISBN</dt>
                          <dd id="displayISBN"></dd>
                          <dt>Title:</dt>
                          <dd id="displayTitle"></dd>
                          <dt>Author:</dt>
                          <dd id="displayAuthor"></dd>
                          <dt>Category:</dt>
                          <dd id="displayCategory"></dd>
                        </dl>
					</div>
				</div>
				<div class="text-right pull-right">
					{{ Form::submit('Issue a Book',['class="btn btn-success"']) }}
				</div>
				{{ Form::close() }}
			</div>
        </div>
        <?php $msg = ""; ?>
        @foreach ($errors->all('<li>:message</li>') as $message)
            <?php $msg = $msg . $message; ?>
        @endforeach
    </div>
@endsection
@section('script')
	<script src="js/jquery-ui.min.js"></script>
	<script type="text/javascript">
		$('#borrower_code').autocomplete({
			source: function( request, response ) {
				$.ajax({
					url : 'searchBorrowersCode',
					dataType: "json",
					data: {
						borrower_code: request.term
					},
					success: function( data ) {
						response( $.map( data, function( item ) {
							return {
								label: item,
								value: item
							}
						}));
					}
				});
			},
			autoFocus: true,
			minLength: 0,
			change: function (event, ui) {
                if(!ui.item){
                    $(this).val('');
                    $('#borrower_id').val('');
                    $('#displayBorrowerCode').html('');
                    $('#displayName').html('');
                } else {
                	var result_borrower_code = $(this).val();

                    $.post('result-borrower-code', {result_borrower_code: result_borrower_code}).done( function(data) {
                    	console.log(data);
                    	$('#borrower_id').val(data[0]['id']);
                    	$('#displayBorrowerCode').html(data[0]['borrower_code']);
                    	$('#displayName').html(data[0]['first_name']+' '+data[0]['last_name']);
                    });
                }
            }       
		});

		$('#ISBN').autocomplete({
			source: function( request, response ) {
				$.ajax({
					url : 'searchISBN',
					dataType: "json",
					data: {
						ISBN: request.term
					},
					success: function( data ) {
						response( $.map( data, function( item ) {
							return {
								label: item,
								value: item
							}
						}));
					}
				});
			},
			autoFocus: true,
			minLength: 0,
			change: function (event, ui) {
                if(!ui.item){
                    $(this).val('');
                    $('#book_id').val('');
                    $('#displayISBN').html('');
                    $('#displayTitle').html('');
                    $('#displayAuthor').html('');
                    $('#displayCategory').html('');
                } else {
                	var result_ISBN = $(this).val();

                    $.post('result-ISBN', {result_ISBN: result_ISBN}).done( function(data) {
                    	$('#book_id').val(data[0]['id']);
	                    $('#displayISBN').html(data[0]['ISBN']);
	                    $('#displayTitle').html(data[0]['title']);
	                    $('#displayAuthor').html(data[0]['author']);
	                    $('#displayCategory').html(data[0]['category']);
                    });
                }
            }       
		});

		@if(Session::has('flash_error'))
			notif({
			  type: "success",
			  msg: "{{Session::get('flash_error')}}<ul>{{ $msg }}</ul>",
			  bgcolor: "#c0392b",
			  multiline: true
			});
		@endif
	</script>
@endsection