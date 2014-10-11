@extends('layout')

@section('title')
    {{$companyName}} | Borrower Request
@endsection

@section('content')
    @include('include.nav')
    <div class="container">
       
        <div class="panel panel-primary"> <!-- TYPE PANEL -->
            <div class="panel-heading"> <!-- HEAD PANEL -->
                <h4 class="panel-title"><i class="fa fa-bookmark"></i>  Borrowers Profile</h4>
            </div><!-- /HEAD PANEL -->          
            <div class="panel-body"> <!-- CONTENT PANEL -->
                <h6>Borrower ID: {{ $borrowers[0]->borrower_code}}</h6>
                <h6>Name: {{ $borrowers[0]->first_name.' '. $borrowers[0]->last_name}}</h6>
                <h6>Penalty: {{ $borrowers[0]->penalty }}</h6>
                <br>
                <div class="bs-example">
                    <ul class="nav nav-tabs">
                        <li><a href="{{ URL::route('borrowers/view/history', array($borrowers[0]->id)) }}"><span class="fa fa-history"></span>  History</a></li>
                        <li class="active"><a href=""><span class="fa fa-bookmark"></span> Request</a></li>
                        <li><a href="{{ URL::route('borrowers/view/unreturn', array($borrowers[0]->id)) }}"><span class="fa fa-book"></span> UnReturn Book</a></li>
                    </ul>
                </div><br>
                <table id="example" class="table table-hover table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Book Title</th>
                            <th>Book Author</th>
                            <th>Category</th>
                            <th>Date Request</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($borrowerRequest as $borrowerRequested)
                        <tr>
                            <td>{{ $borrowerRequested->ISBN }}</td>
                            <td>{{ $borrowerRequested->title }}</td>
                            <td>{{ $borrowerRequested->author }}</td>
                            <td>{{ $borrowerRequested->category }}</td>
                            <td>{{ $borrowerRequested->reservedDate }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ISBN</th>
                            <th>Book Title</th>
                            <th>Book Author</th>
                            <th>Category</th>
                            <th>Date Request</th>
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
                "order": [[ 5, "asc" ]]
            });
        });
    </script>
@endsection

    