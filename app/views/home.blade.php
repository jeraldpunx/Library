@extends('layout')

@section('content')
	@include('include.nav')
	<table data-toggle="table" data-url="data1.json" data-cache="false" data-height="299">
	    <thead>
	        <tr>
	            <th data-field="id">Item ID</th>
	            <th data-field="name">Item Name</th>
	            <th data-field="price">Item Price</th>
	        </tr>
	    </thead>
	</table>
@endsection
@section('script')
@endsection