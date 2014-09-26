<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div id="container">
		<div id="nav">
            <ul>
                <li>{{ link_to('/', 'Home') }}</li>
                @if(Auth::check())
                    <li>{{ link_to('profile', 'Profile') }}</li>
                    <li>{{ link_to('logout', 'Logout') }}</li>
                @else
                    <li>{{ link_to('login', 'Login') }}</li>
                    <li>{{ link_to('register', 'Register') }}</li>
                @endif
            </ul>
        </div>

		@yield('content')
	</div>
</body>
</html>