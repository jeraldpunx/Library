@extends('layout')

@section('content')
    <style type="text/css">
        #ui_notifIt {
            top: 70px;
        }
    </style>
	@include('include.nav')
<div class="container">
    <div class="row search">   
        <div class="search-form col-xs-8 col-xs-offset-2">
            <h1 class="search_book_title">Search Book:</h1>
            <form class="input-group">
                <div class="input-group-btn search-panel btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span id="search_concept">All</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#all" data-searchby="all">All</a></li>
                      <li class="divider"></li>
                      <li><a href="#isbn">ISBN</a></li>
                      <li><a href="#title">Title</a></li>
                      <li><a href="#author">Author</a></li>
                      <li><a href="#category">Category</a></li>
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input id="search-field" type="text" class="form-control" name="x" placeholder="Search book...">
                <span class="input-group-btn">
                    <button id="go" class="btn btn-default" type="submit"><span class="fui-search"></span></button>
                </span>
            </form>
        </div>
    </div>
    <div id="result-search">
        <div class="container">
            <!-- DISPLAY RESULTS HERE -->
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(function() {
        $('.search-panel .dropdown-menu').find('a').click(function(e) {
            e.preventDefault();
            var param = $(this).attr("href").replace("#","");
            var concept = $(this).text();
            $('.search-panel span#search_concept').text(concept);
            $('.input-group #search_param').val(param);
        });

        $( "#go" ).click(function(e) {
            e.preventDefault();
            var result_search = $('#result-search .container');
            var search_field = $("#search-field").val();
            var search_book_title = $('.search_book_title');
            var search = $( ".search" );

            result_search.hide('fast').html('');
            if(!search_field) {
                search.animate({ padding: "100px" }, 600 );
                search_book_title.show( "slow" );
            } else {
                search.animate({ padding: "60px" }, 600 );
                search_book_title.hide( "slow" );
                var search_concept = $('#search_concept').text();

                $.post('result-search-data', {search_field: search_field, search_concept: search_concept}).done( function(data)
                {
                    result_search.append('<hgroup class="mb20"><h1>Search Results</h1><h2 class="lead"><strong class="text-danger">'+data['book_count']+'</strong> results were found for the search for <strong class="text-danger">'+search_field+'</strong></h2></hgroup>');

                    $.each(data, function(bb) {
                        $.each(this, function(cc) {
                            result_search.append('<article class="search-result row"><div class="col-xs-12 col-sm-12 col-md-3"><a href="#" title="'+data[bb][cc]['title']+'" class="thumbnail"><img src="{{URL::to('/img/upload')}}/'+data[bb][cc]['image']+'" /></a></div><div class="col-xs-12 col-sm-12 col-md-2"><ul class="meta-search"><li><i class="fa fa-book"></i><span>'+data[bb][cc]['ISBN']+'</span></li><li><i class="fa fa-user"></i><span>'+data[bb][cc]['author']+'</span></li><li><i class="fa fa-calendar"></i><span>'+data[bb][cc]['created_at']+'</span></li><li><i class="fa fa-tags"></i><span>'+data[bb][cc]['category']+'</span></li></ul></div><div class="col-xs-12 col-sm-12 col-md-7 excerpet"><h3><a href="#" title="">'+data[bb][cc]['title']+'</a></h3><p>'+data[bb][cc]['description']+'</p><span class="plus"><button data-id="'+data[bb][cc]['id']+'" class="btn btn-success requestBook"><i class="fa fa-plus"></i> Request</button></span></div><span class="clearfix borda"></span></article>' );
                            
                        });
                    });
                    result_search.show('slow');
                });
            }
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