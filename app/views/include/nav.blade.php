<div role="navigation" class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="{{ URL::route('home') }}" class="navbar-brand">{{$companyName}} </a>
		</div>
<!-- CHECK IF LOGIN -->
@if(Auth::check())
	<!-- CHECK IF ADMIN OR NORMAL -->
	@if(Auth::user()->previlage == 0)
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-left">
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-gears"></i> Manage<span class="caret"></span></a>
					<ul role="menu" class="dropdown-menu">
						<li><a href="{{ URL::route('books') }}"><i class="fui-book"></i> Books</a></li>
						<li><a href="{{ URL::route('borrowers') }}"><i class="fui-user"></i> Borrowers</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-info-circle"></i> Transaction <b class="caret"></b></a>
					<span class="dropdown-arrow"></span>
					<ul class="dropdown-menu">
						<li><a href="{{ URL::route('adminHistory') }}"><i class="fa fa-history"></i> History</a></li>
						<li><a href="{{ URL::route('adminRequest') }}"><i class="fa fa-bookmark"></i> Request @if(Notification::count() > 0)<span class="badge" style="background-color: #1abc9c;">{{ Notification::count(); }}</span>@endif</a></li>
						<li><a href="{{ URL::route('adminUnreturn') }}"><i class="fa fa-book"></i> Unreturned Books</a></li>
					</ul>
				</li>
				<li><a href="{{ URL::route('issueBook') }}"><i class="fa fa-book"></i> Issue a Book</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fui-user"></i> {{Auth::user()->username}}<span class="caret"></span></a>
					<ul role="menu" class="dropdown-menu">
						<li><a href="{{ URL::route('logout') }}"><i class="fui-power"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	
	@elseif(Auth::user()->previlage == 1)
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="{{ URL::route('home') }}"><i class="fa fa-search"></i> Search</a></li>
				<li><a href="{{ URL::route('userBooks') }}"><i class="fa fa-book"></i> Books</a></li>
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-info-circle"></i> Transaction <b class="caret"></b></a>
					<span class="dropdown-arrow"></span>
					<ul class="dropdown-menu">
						<li><a href="{{ URL::route('userHistory') }}"><i class="fa fa-history"></i> My History</a></li>
						<li><a href="{{ URL::route('userRequest') }}"><i class="fa fa-bookmark"></i> My Request</a></li>
						<li><a href="{{ URL::route('userUnreturn') }}"><i class="fa fa-book"></i> My Unreturned Books</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				@if($bookUnreturn > 0)
				{{ '<li><a href="'.URL::route('userUnreturn').'" style="color: #c0392b;">Unreturn Book: '.$bookUnreturn.'</a></li>'}}
				@endif
				@if($borrowers[0]->penalty > 0)
				{{ '<li><a href="#" style="color: #c0392b;">Penalty: $'.$borrowers[0]->penalty.'</a></li>'}}
				@endif
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fui-user"></i> {{Auth::user()->username}}<span class="caret"></span></a>
					<ul role="menu" class="dropdown-menu">
						<li><a href="{{ URL::route('manageProfile') }}"><i class="fui-gear"></i> Manage Profile</a></li>
						<li class="divider"></li>
						<li><a href="{{ URL::route('logout') }}"><i class="fui-power"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	@endif
@else
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="{{ URL::route('home') }}"><i class="fa fa-search"></i> Search</a></li>
				<li><a href="{{ URL::route('userBooks') }}"><i class="fa fa-book"></i> Books</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="{{ URL::route('register') }}"><i class="fa fa-angle-double-right"></i> Register</a></li>
				<li><a href="{{ URL::route('login') }}"><i class="fa fa-sign-in"></i> Login</a></li>
			</ul>
		</div><!--/.nav-collapse -->
@endif
	</div>
</div>