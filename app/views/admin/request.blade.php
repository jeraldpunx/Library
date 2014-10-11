@extends('layout')

@section('title')
    {{$companyName}} | Request
@endsection

@section('content')
    @include('include.nav')
    
     <div class="container">
            <h5><i class="fa fa-bookmark"></i> Request</h5>
            <div class="hr"><hr /></div><br><br>
        <div class="panel panel-primary"> <!-- TYPE PANEL -->
            <div class="panel-heading"> <!-- HEAD PANEL -->
                <h4 class="panel-title"><i class="fa fa-bookmark"></i> Request</h4>
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
                            <th>Date Requested</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($requests as $request)
                        <tr>
                            <td>{{ $request->borrower_code }}</td>
                            <td>{{ $request->first_name . ' ' . $request->last_name }}</td>
                            <td>{{ $request->ISBN }}</td>
                            <td>{{ $request->title }}</td>
                            <td>{{ $request->author }}</td>
                            <td>{{ $request->reservedDate }}</td>
                            <td><a class="btn btn-info approve" data-id="{{ $request->transaction_id }}" href="#"><span class="fa fa-thumbs-up"> Approve</span></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Borrower Code</th>
                            <th>Name</th>
                            <th>ISBN</th>
                            <th>Book Title</th>
                            <th>Book Author</th>
                            <th>Date Requested</th>
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

            $('.approve').click(function() {
                var transaction_id = $(this).data('id');
                $(this).parent().parent().remove();
                $.ajax({
                    method: 'post',
                    url: 'approve-request',
                    data: {transaction_id: transaction_id},
                    success: function(e) {
                        notif({
                            msg: "Successfully Approved!",
                            bgcolor: "#27ae60"
                        });
                    },
                    error: function(e) {
                        notif({
                            msg: "Failed to approve request.",
                            bgcolor: "#c0392b"
                        });
                    }
                });
            });
        });
    </script>
@endsection

    