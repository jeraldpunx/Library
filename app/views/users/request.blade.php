@extends('layout')

@section('content')
    <style type="text/css">
        #ui_notifIt {
            top: 70px;
        }
        .delete {
            padding: 7px 18px;
            line-height: 1.2;
            font-size: 15px;
        }
    </style>
    @include('include.nav')
    
    <div class="container">
        <div class="panel panel-default"> <!-- TYPE PANEL -->
            <div class="panel-heading"> <!-- HEAD PANEL -->
                <h4 class="panel-title"><i class="fa fa-bookmark"></i>  My Request</h4>
            </div><!-- /HEAD PANEL -->
                    
            <div class="panel-body"> <!-- CONTENT PANEL -->
                <table id="example" class="table table-hover table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
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
                            <td>{{ $request->ISBN }}</td>
                            <td>{{ $request->title }}</td>
                            <td>{{ $request->author }}</td>
                            <td>{{ $request->reservedDate }}</td>
                            <td><a class="btn btn-danger delete" data-id="{{ $request->transaction_id }}" href="#"><span class="fa fa-trash"> Cancel</span></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
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
                "order": [[ 3, "desc" ]],
                "columnDefs": [
                    { "width": "5%", "targets": 4 }
                ]
            });

            $('.delete').click(function() {
                var transaction_id = $(this).data('id');
                $(this).parent().parent().remove();
                $.ajax({
                    method: 'post',
                    url: 'delete-request',
                    data: {transaction_id: transaction_id},
                    success: function(e) {
                        notif({
                            msg: "Successfully canceled!",
                            bgcolor: "#27ae60"
                        });
                    },
                    error: function(e) {
                        notif({
                            msg: "Failed to cancel request.",
                            bgcolor: "#c0392b"
                        });
                    }
                });
            });
        });
    </script>
@endsection

    