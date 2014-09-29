<div role="navigation" class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="{{ URL::route('home') }}" class="navbar-brand">{{$companyName}}</a>
		</div>

<!-- CHECK IF LOGIN -->
@if(Auth::check())
	<!-- CHECK IF ADMIN OR NORMAL -->
	@if(Auth::user()->previlage == 0)
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="{{ URL::route('home') }}">Home</a></li>
				<li><a href="#about">Profile</a></li>
				<li><a href="#contact">Issue Books</a></li>
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">Dropdown <span class="caret"></span></a>
					<ul role="menu" class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Nav header</li>
						<li><a href="#">Separated link</a></li>
						<li><a href="#">One more separated link</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fui-user"></i> {{Auth::user()->username}} <span class="caret"></span></a>
					<ul role="menu" class="dropdown-menu">
						<li><a href="{{ URL::route('logout') }}"><i class="fui-power"></i>Logout</a></li>
					</ul>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	
	@elseif(Auth::user()->previlage == 1)
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="{{ URL::route('home') }}">Search</a></li>
				<li><a href="#about">Transaction</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fui-user"></i> {{Auth::user()->username}} <span class="caret"></span></a>
					<ul role="menu" class="dropdown-menu">
						<li><a href="#"><i class="fui-gear"></i> Manage Profile</a></li>
						<li class="divider"></li>
						<li><a href="{{ URL::route('logout') }}"><i class="fui-power"></i>Logout</a></li>
					</ul>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	@endif
@else
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="{{ URL::route('home') }}">Home</a></li>
				<li><a href="#about">Search</a></li>
				<li><a href="#contact">Contact</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="{{ URL::route('register') }}">Register</a></li>
				<li><a href="{{ URL::route('login') }}">Login</a></li>
			</ul>
		</div><!--/.nav-collapse -->
@endif


	</div>
</div>