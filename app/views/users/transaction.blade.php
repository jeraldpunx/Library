@extends('layout')

@section('content')
	@include('include.nav')
<div class="container">
	<div class="tab">
		<ul class="nav nav-tabs" role="tablist">
	  		<li class="active"><a href="borrow">Home</a></li>
            <li><a href="borrow">Borrow</a></li>
            <li><a href="borrow">Reserve</a></li>
            <a href="#" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new categories</a>
		</ul>
	</div>
	<div class="row col-md-15 col-md-offset-0 custyle">
    <table class="table table-striped custab">
    <thead>
        <tr>
            <th>Student Id</th>
            <th>Name</th>
            <th>Borrowed books</th>
            <th>Borrowed date</th>
        </tr>
    </thead>
            <tr>
                <td>1</td>
                <td>News</td>
                <td>News Cate</td>
                <td class="text-center"><a class='btn btn-info btn-xs' href="#"><span class="glyphicon glyphicon-edit"></span> Edit</a> <a href="#" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Products</td>
                <td>Main Products</td>
                <td class="text-center"><a class='btn btn-info btn-xs' href="#"><span class="glyphicon glyphicon-edit"></span> Edit</a> <a href="#" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Blogs</td>
                <td>Parent Blogs</td>
                <td class="text-center"><a class='btn btn-info btn-xs' href="#"><span class="glyphicon glyphicon-edit"></span> Edit</a> <a href="#" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Del</a></td>
            </tr>
    </table>
    </div>
</div>

@endsection