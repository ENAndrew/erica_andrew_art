@extends ('layouts.admin')

@section ('content')
	<div class="user-index-wrapper">
		<div class="clearfix">
			<h1 class="float-left">Users</h1>

			<a href="{{ route('admin.users.create') }}" class="float-right">
				<i class="fas fa-plus"></i> New User
			</a>
		</div>

		<table class="table">
			<thead>
				<th>Name</th>

				<th>Actions</th>

				<th>&nbsp</th>
			</thead>
		</table>
	</div>
@endsection