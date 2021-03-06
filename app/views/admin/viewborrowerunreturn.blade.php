@extends('layout')

@section('title')
    {{$companyName}} | Borrower Unreturn
@endsection

@section('content')
    @include('include.nav')
    {{ HTML::style('css/style1.css') }}
    <div class="container">
        <h5><i class="fa fa-bookmark"></i> Borrower Transactions</h5>
        <div class="hr"><hr /></div><br><br>
        <div class="panel panel-primary"> <!-- TYPE PANEL -->
            <div class="panel-heading"> <!-- HEAD PANEL -->
                <h4 class="panel-title"><i class="fa fa-bookmark"></i>  Borrowers Transactions</h4>
            </div><!-- /HEAD PANEL -->          
            <div class="panel-body"> <!-- CONTENT PANEL -->
                <h6>Borrower ID: {{ $borrowers[0]->borrower_code}}</h6>
                <h6>Name: {{ $borrowers[0]->first_name.' '. $borrowers[0]->last_name}}</h6>
                <h6>Penalty: {{ $borrowers[0]->penalty }}</h6>
                <br>
                <div class="bs-example">
                    <ul class="nav nav-tabs">
                        <li><a href="{{ URL::route('borrowers/view/history', array($borrowers[0]->id)) }}"><span class="fa fa-history"></span>  History</a></li>
                        <li><a href="{{ URL::route('borrowers/view/request', array($borrowers[0]->id)) }}"><span class="fa fa-bookmark"></span> Request</a></li>
                        <li class="active"><a href=""><span class="fa fa-book"></span> UnReturn Book</a></li>
                    </ul>
                </div><br>
                <table id="example" class="table table-hover table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Book Title</th>
                            <th>Book Author</th>
                            <th>Category</th>
                            <th>Date Borrowed</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($borrowerUnreturn as $borrowerUnreturned)
                        <tr>
                            <td>{{ $borrowerUnreturned->borrower_code }}</td>
                            <td>{{ $borrowerUnreturned->title }}</td>
                            <td>{{ $borrowerUnreturned->author }}</td>
                            <td>{{ $borrowerUnreturned->category }}</td>
                            <td>{{ $borrowerUnreturned->borrowedDate }}</td>
                            <td>{{ $borrowerUnreturned->returnedDate }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ISBN</th>
                            <th>Book Title</th>
                            <th>Book Author</th>
                            <th>Category</th>
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
                "order": [[ 5, "asc" ]]
            });
        });
    </script>
@endsection