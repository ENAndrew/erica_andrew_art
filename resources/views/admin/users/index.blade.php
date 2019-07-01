@extends ('layouts.admin')

@section ('content')
	<div class="user-index-wrapper">
		<div class="d-flex vertical-align justify-content-between">
			<h1>Users</h1>

			<a href="{{ route('admin.users.create') }}">
				<button class="btn btn-primary">
					<i class="fa fa-plus"></i> New User
				</button>
			</a>
		</div>

		<table class="table">
			<thead>
				<th>Name</th>

				<th>Email</th>

				<th>Actions</th>

				<th>&nbsp</th>
			</thead>

			<tbody>
				@foreach ($users as $user)
					<tr>
						<td>
							<a href="{{ route('admin.users.edit', $user) }}">{{ $user->first_name }} {{ $user->last_name }}</a>
						</td>

						<td>{{ $user->email }}</td>

						<td>
							<a href="{{ route('admin.users.edit', $user) }}">
								<i title="Edit" class="fa fa-edit"></i>
							</a>
						</td>

						<td>
							<form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="if(!confirm('Are you sure? This is permanent.')) return false">
								@csrf @method('DELETE')

								<button type="submit" style="background-color: white; color: red;">
									<i title="Delete" class="fa fa-trash"></i>
								</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection
