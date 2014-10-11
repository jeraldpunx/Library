@extends('layout')

@section('title')
    {{$companyName}} | Admin
@endsection

@section('content')
    @include('include.nav')
    <title>Admin | Home</title>
        <div class="container">
            <h5><i class="fa fa-dashboard"></i> Admin Dashboard</h5>
            <div class="hr"><hr /></div><br><br>
            <div id="carousel1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <img  src="img/2.jpg">
                        <div class="carousel-caption">
                                   
                        </div>
                    </div>
                    <div class="item">
                        <img  src="img/1.jpg">
                        <div class="carousel-caption">
     
                        </div>
                    </div>
                    <div class="item">
                        <img  src="img/4.jpg">
                        <div class="carousel-caption">
           
                        </div>
                    </div>
                    <div class="item">
                        <img  src="img/3.jpg">
                        <div class="carousel-caption">
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
<style>      

#carousel1 .nav a small {
    display: block;
}
#carousel1 .nav {
    background: #eee;
}
.nav-justified > li > a {
    border-radius: 0px;
}
.nav-pills > li[data-slide-to="0"].active a {
    background-color: #b4d9a7;
}
.nav-pills > li[data-slide-to="1"].active a {
    background-color: #4f77cb;
}
.nav-pills > li[data-slide-to="2"].active a {
    background-color: #d11e4f;
}
</style>
<script type="text/javascript">
    jQuery(function ($) {
        $('#carousel1').carousel({
        interval: 300
         });

        var clickEvent = false;

        $('#carousel1').on('click', '.nav a', function () {
            clickEvent = true;
            $('.nav li').removeClass('active');
                $(this).parent().addClass('active');
        }).on('slid.bs.carousel', function (e) {
            if (!clickEvent) {
            var count = $('.nav').children().length - 1;
            var current = $('.nav li.active');
                current.removeClass('active').next().addClass('active');
                var id = parseInt(current.data('slide-to'));
                if (count == id) {
                    $('.nav li').first().addClass('active');
                }
            }
            clickEvent = false;
        });
    });
</script>
@endsection
@section('script')
@endsection