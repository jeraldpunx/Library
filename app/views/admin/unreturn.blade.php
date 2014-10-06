@extends('layout')

@section('content')
    @include('include.nav')
    
    <div class="container">
        <div class="panel panel-primary"> <!-- TYPE PANEL -->
            <div class="panel-heading"> <!-- HEAD PANEL -->
                <h4 class="panel-title"><i class="fa fa-book"></i>  Unreturned Books</h4>
            </div><!-- /HEAD PANEL -->
                    
            <div class="panel-body"> <!-- CONTENT PANEL -->
                <table id="example" class="table table-hover table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Borrowers ID</th>
                            <th>Name</th>
                            <th>ISBN</th>
                            <th>Book Title</th>
                            <th>Book Author</th>
                            <th>Date Borrowed</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($unreturns as $unreturn)
                        <tr>
                            <td>{{ $unreturn->borrower_code }}</td>
                            <td>{{ $unreturn->first_name . ' ' . $unreturn->last_name }}</td>
                            <td>{{ $unreturn->ISBN }}</td>
                            <td>{{ $unreturn->title }}</td>
                            <td>{{ $unreturn->author }}</td>
                            <td>{{ $unreturn->borrowedDate }}</td>
                            <td><a class="btn btn-success return" data-id="{{ $unreturn->transaction_id }}" href="#"><span class="fa fa-mail-reply"> Return</span></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Borrowers ID</th>
                            <th>Name</th>
                            <th>ISBN</th>
                            <th>Book Title</th>
                            <th>Book Author</th>
                            <th>Date Borrowed</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').dataTable({
                "order": [[ 5, "asc" ]],
                "columnDefs": [
                    { "width": "5%", "targets": 6 }
                ]
            });

            $('.return').click(function() {
                var transaction_id = $(this).data('id');
                $(this).parent().parent().remove();
                $.ajax({
                    method: 'post',
                    url: 'return-book',
                    data: {transaction_id: transaction_id},
                    success: function(e) {
                        console.log(e);
                        notif({
                            msg: "Successfully return!",
                            bgcolor: "#27ae60"
                        });
                    },
                    error: function(e) {
                        notif({
                            msg: "Failed to return book.",
                            bgcolor: "#c0392b"
                        });
                    }
                });
            });

            @if(Session::has('flash_error'))
                notif({
                  msg: "{{Session::get('flash_error')}}",
                  type: "success",
                  bgcolor: "#27ae60"
                });
            @endif
        });
    </script>
@endsection

    