<nav class="navbar fixed-top shadow navbar-expand-md">
	<div class="container">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav">
			<i class="fa fa-bars fa-lg"></i>
		</button>

		<div class="collapse navbar-collapse" id="main-nav">
			<div class="navbar-nav w-100 d-flex justify-content-between">
				<a class="nav-item nav-link {{ ActiveRoute::startsWith('home') }}" href="{{ route('home') }}">Home</a>
				
				<a class="nav-item nav-link {{ ActiveRoute::startsWith('digital') }}" href="{{ route('digital') }}">Digital</a>

				<a class="nav-item nav-link {{ ActiveRoute::startsWith('traditional') }}" href="{{ route('traditional') }}">Traditional</a>

				<a class="nav-item nav-link {{ ActiveRoute::startsWith('design') }}" href="{{ route('design') }}">Dev/Design</a>

				<a class="nav-item nav-link {{ ActiveRoute::startsWith('contact') }}" href="{{ route('contact') }}">Contact</a>
			</div>
		</div>
	</div>
</nav>
