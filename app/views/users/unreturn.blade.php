@extends('layout')

@section('content')
    @include('include.nav')
    
    <div class="container">
        <div class="panel panel-default"> <!-- TYPE PANEL -->
            <div class="panel-heading"> <!-- HEAD PANEL -->
                <h4 class="panel-title"><i class="fa fa-book"></i>  My Unreturned Books</h4>
            </div><!-- /HEAD PANEL -->
                    
            <div class="panel-body"> <!-- CONTENT PANEL -->
                <table id="example" class="table table-hover table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Book Title</th>
                            <th>Book Author</th>
                            <th>Date Requested</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($unreturns as $unreturn)
                        <tr>
                            <td>{{ $unreturn->ISBN }}</td>
                            <td>{{ $unreturn->title }}</td>
                            <td>{{ $unreturn->author }}</td>
                            <td>{{ $unreturn->borrowedDate }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ISBN</th>
                            <th>Book Title</th>
                            <th>Book Author</th>
                            <th>Date Borrowed</th>
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
                "order": [[ 3, "desc" ]]
            });
        });
    </script>
@endsection

    