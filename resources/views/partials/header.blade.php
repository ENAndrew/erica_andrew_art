<nav class="navbar-fixed-top border-bottom header-wrapper">
	<div class="container py-3 desk-nav">
		<div class="nav-items d-flex justify-content-between">
			<div class="nav-item">
				<a href="{{ route('home') }}">Home</a>
			</div>

			<div class="nav-item">
				<a href="{{ route('traditional') }}">Traditional</a>
			</div>

			<div class="nav-item">
				<a href="{{ route('digital') }}">Digital</a>
			</div>

			<div class="nav-item">
				<a href="{{ route('design') }}">Dev/Design</a>
			</div>

			<div class="nav-item">
				<a href="{{ route('contact') }}">Contact</a>
			</div>
		</div>
	</div>

	<div class="container py-3 mobile-nav">
		<mobile-dropdown></mobile-dropdown>
	</div>
</nav>