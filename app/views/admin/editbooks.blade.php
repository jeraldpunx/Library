@extends('layout')

@section('title')
    {{$companyName}} | Edit Book
@endsection

@section('content')
    @include('include.nav')
    {{ Form::model($books, ['route' => ['books/update', $books['id']],'method' => 'put', 'files'=>true]) }}
    <div class="container">
        <h4><i class="fa fa-edit"></i> Edit Books</h4>
        <div class="hr"><hr /></div><br><br>
            <div class="col-md-13">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><i class="fa fa-edit"></i> Edit Books </strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                {{ Form::label('image', 'IMAGE', array('class' => 'col-sm-2 control-label')) }}
                                <div class="col-sm-8">
                                    {{ Form::file('image') }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('ISBN', 'ISBN', array('class' => 'col-sm-2 control-label')) }}
                                <div class="col-sm-8">
                                    {{ Form::text('ISBN',$books['ISBN'], array('class' => 'form-control','placeholder'=>'ISBN')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('title', 'TITLE', array('class' => 'col-sm-2 control-label')) }}
                                <div class="col-sm-8">
                                    {{ Form::text('title',$books['title'], array('class' => 'form-control','placeholder'=>'Title')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('author', 'AUTHOR', array('class' => 'col-sm-2 control-label')) }}
                                <div class="col-sm-8">
                                    {{ Form::text('author',$books['author'], array('class' => 'form-control','placeholder'=>'Author')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('description', 'DESCRIPTION', array('class' => 'col-sm-2 control-label')) }}
                                <div class="col-sm-8">
                                    {{ Form::textarea('description',$books['description'], array('class'=>'form-control','rows'=>'3','placeholder'=>'Description')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('category', 'CATEGORY', array('class' => 'col-sm-2 control-label')) }}
                                <div class="col-sm-8">
                                    {{ Form::text('category',$books['category'], array('class' => 'form-control','placeholder'=>'Category')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('quantity', 'QUANTITY', array('class' => 'col-sm-2 control-label')) }}
                                <div class="col-sm-8">
                                    {{ Form::text('quantity',$books['quantity'], array('class' => 'form-control','placeholder'=>'Quantity')) }}
                                </div>
                            </div>
                        </div>  
                        <div style="margin-left: 820px;">
                            {{ Form::submit('Update',['class="btn btn-primary"']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
    <?php $msg = ""; ?>
    @foreach ($errors->all('<li>:message</li>') as $message)
        <?php $msg = $msg . $message; ?>
    @endforeach
@endsection

@section('script')
    <script>
        $(function() {
            @if(Session::has('flash_error'))
                notif({
                  type: "success",
                  msg: "<ul>{{ $msg }}</ul>",
                  bgcolor: "#c0392b",
                  multiline: true
                });
            @endif
        });
    </script>
@endsection