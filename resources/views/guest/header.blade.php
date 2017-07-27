{{ App::setLocale(session('lang')) }}
<div class="header clearfix">
	<nav>
	  <ul class="nav nav-pills pull-right">
	  	@if (Sentinel::check())
	  		<li role="presentation">
	  			<a href="/logout">Logout</a>
	  		</li>
	  	@else	
		    <li role="presentation"><a href="/login">Login</a></li>
		    <li role="presentation"><a href="/register">Register</a></li>
	  	@endif
	  </ul>
	</nav>
	<h3 class="text-muted">
		@if (Sentinel::check())
			<h3>Welcome {{ Sentinel::getUser()->first_name }}</h3>
		@else
			{{-- false expr --}}
			Web Translate
		@endif
	</h3>
</div>