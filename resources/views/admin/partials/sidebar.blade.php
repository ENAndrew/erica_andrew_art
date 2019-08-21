<div class="col-sm-3">
	<ul class="admin-nav">
		<li>
			<a href="{{ route('admin.dashboard') }}">Admin Home</a>
		</li>

		<li>
			<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>

			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
		</li>

		<li>
			<a href="{{ route('admin.images.index') }}">Images</a>
		</li>

		<li>
			<a href="{{ route('admin.image-types.index') }}">Image Types</a>
		</li>

		<li>
			<a href="{{ route('admin.users.index') }}">Users</a>
		</li>
	</ul>
</div>
