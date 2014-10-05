@extends('layout')

@section('content')
    @include('include.nav')

    <div class="container">
        <h4 style="margin-left: 14px;">All Books</h4>
        <div class="hr"><hr /></div><br><br>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Books </strong></h3>
                </div>
                <div class="panel-body">
                    {{ link_to('books/add', '+ Add Books',['class="btn btn-primary"']) }}
                    <br><br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><center>ISBN</center></th>
                                <th><center>Title</center></th>
                                <th><center>Author</center></th>
                                <th><center>Category</center></th>
                                <th><center>Available</center></th>
                                <th><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td><center>{{ $book['ISBN'] }}<center></td>
                                <td><center>{{ $book['title'] }}<center></td>
                                <td><center>{{ $book['author'] }}<center></td>
                                <td><center>{{ $book['category'] }}<center></td>
                                <td><center>{{ $book['quantity'] }}<center></td>
                                <td class="text-center">{{ link_to('books/'.$book['id'].'/edit','Edit',array('class'=>'btn btn-primary btn-xs')) }}
                                {{ link_to(''.$book['id'],'Del',array('class'=>'btn btn-danger btn-xs','data-toggle'=>'modal','data-target'=>'#confirm-delete')) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div align ="right">
                        {{ $books->links() }}   
                    </div>    
                </div>
            </div>
        </div>
        @if($books)
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Are you sure you want to delete?</h4>
                    </div>
                    <div class="modal-body">
                        <dl class="dl-horizontal">
                          <dt>ISBN Code:</dt>
                          <dd>{{ $book['ISBN'] }}</dd>
                          <dt>Title:</dt>
                          <dd>{{ $book['title'] }}</dd>
                          <dt>Author:</dt>
                          <dd>{{ $book['author'] }}</dd>
                          <dt>Category:</dt>
                          <dd>{{ $book['category'] }}</dd>
                        </dl>
                    </div>
                    <div class="modal-footer">
                            <?php $id = $book['id']; ?>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <a href="{{ URL::route('books/delete', $id) }}" class="btn btn-danger danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('html'));
        });
    </script>
@endsection