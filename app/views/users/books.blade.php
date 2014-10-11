@extends('layout')

@section('title')
    {{$companyName}} | Books
@endsection

@section('content')
    @include('include.nav')
    
     <div class="container">
            <h5><i class="fa fa-book"></i> All Books</h5>
            <div class="hr"><hr /></div><br><br>
        <div class="panel panel-primary"> <!-- TYPE PANEL -->
            <div class="panel-heading"> <!-- HEAD PANEL -->
                <h4 class="panel-title"><i class="fa fa-book"></i> All Books</h4>
            </div><!-- /HEAD PANEL -->
                    
            <div class="panel-body"> <!-- CONTENT PANEL -->
                <table id="example" class="table table-hover table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td><center>{{ $book['ISBN'] }}<center></td>
                            <td><center>{{ $book['title'] }}<center></td>
                            <td><center>{{ $book['author'] }}<center></td>
                            <td><center>{{ $book['category'] }}<center></td>
                            <td><center><span class="plus"><button data-id="{{ $book['id'] }}" class="btn btn-sm btn-success requestBook"><i class="fa fa-plus"></i> Request</button></span><center></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ISBN</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
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
                "order": [[ 1, "desc" ]],
                "columnDefs": [
                    { "width": "5%", "targets": 4 }
                ]
            });
        });

        $(document).on("click", ".requestBook", function(e) {
            e.preventDefault();
            @if(!Auth::check())
                window.location = "{{ URL::route('login') }}";
                return false;
            @else
                var borrowerId = {{ Auth::user()->borrower_id }};
                var bookId = $(this).data("id");

                var msg = "";
                var bgcolor = "";
                $.post('request-book-data', {borrowerId: borrowerId, bookId: bookId}).done( function(data) {
                    if(data == 1) {
                        msg = "Successful! You have made a request.";
                        bgcolor = "#27ae60";
                    } else {
                        msg = "Failed to request this book! One of reasons.<ul><li>You already requested this book</li><li>You still have pending payment.</li><li>You are still borrowing this Book.</li></ul>";
                        bgcolor = "#c0392b";
                    }
                    notif({
                        msg: msg,
                        bgcolor: bgcolor,
                        multiline: true
                    });
                });
            @endif
        });
    </script>
@endsection

    