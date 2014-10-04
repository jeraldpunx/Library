@extends('layout')

@section('content')
    @include('include.nav')
    
    <div class="container">
        <div class="panel panel-primary"> <!-- TYPE PANEL -->
            <div class="panel-heading"> <!-- HEAD PANEL -->
                <h4 class="panel-title"><i class="fa fa-history"></i>  My Transaction History</h4>
            </div><!-- /HEAD PANEL -->
                    
            <div class="panel-body"> <!-- CONTENT PANEL -->
                <table id="example" class="table table-hover table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Book Title</th>
                            <th>Book Author</th>
                            <th>Date Requested</th>
                            <th>Date Returned</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($histories as $history)
                        <tr>
                            <td>{{ $history->ISBN }}</td>
                            <td>{{ $history->title }}</td>
                            <td>{{ $history->author }}</td>
                            <td>{{ $history->borrowedDate }}</td>
                            <td>{{ $history->returnedDate }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ISBN</th>
                            <th>Book Title</th>
                            <th>Book Author</th>
                            <th>Date Borrowed</th>
                            <th>Date Returned</th>
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
                "order": [[ 4, "desc" ]]
            });
        });
    </script>
@endsection

    