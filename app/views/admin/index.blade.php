@extends('layout')

@section('content')
    @include('include.nav')
         {{ HTML::style('css/style1.css') }}
        <div class="container" style="margin-top:80px">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title"><strong>Books </strong></h3></div>
                        <div class="panel-body">
                            This is Index
                        </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
@endsection