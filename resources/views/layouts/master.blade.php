<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="{{ url('css/style.css') }}">
</head>
<body>
	<div class="site-main">
		<header>
			<nav>
				<ul>
					<li><a href="{{ url('/') }}">Home</a></li>
					@if(!\Auth::check())
					<li><a href="{{ url('/auth/login') }}">Login</a></li>
					<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
					<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
					<li><a href="{{ url('/user/'.\Auth::user()->id) }}">Profile</a></li>
					@endif
					<li><a href="{{ url('/members') }}">Members</a></li>
				</ul>
				<section class="welcome">
					<span>
						@if(\Auth::check())
						{{ 'Hello '.\Auth::user()->username.'!' }}
						@else
						{{ 'Hello guest!' }}
						@endif
					</span>
				</section>
			</nav>
		</header>

		<section class="site-content">
			@if(Session::has('flash_message'))
				<p class="error">{{ Session::get('flash_message') }}</p>
			@endif
			@yield('content')			
		</section>
		
	</div>
	@yield('script')
</body>
</html>