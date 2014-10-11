@extends('layout')

@section('title')
    {{$companyName}} | Unreturn
@endsection

@section('content')
    @include('include.nav')
    
    <div class="container">
        <div class="panel panel-primary"> <!-- TYPE PANEL -->
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
                            <th>Must Return Before</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($unreturns as $unreturn)
                        <tr>
                            <td>{{ $unreturn->ISBN }}</td>
                            <td>{{ $unreturn->title }}</td>
                            <td>{{ $unreturn->author }}</td>
                            <td>{{ $unreturn->borrowedDate }}</td>
                            <td>
                            <?php
                                $date = strtotime('+'.Borrower::$daysExpired.' days', strtotime($unreturn->borrowedDate) );
                                echo date('Y-m-d',$date);
                            ?>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ISBN</th>
                            <th>Book Title</th>
                            <th>Book Author</th>
                            <th>Date Borrowed</th>
                            <th>Must Return Before</th>
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
                "order": [[ 3, "asc" ]],
                "columnDefs": [
                    { "width": "18%", "targets": 4 }
                ]
            });
        });
    </script>
@endsection

    