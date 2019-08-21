@extends ('layouts.admin')

@section ('content')
	<div class="image-types-index-wrapper">
		<div class="d-flex vertical-align justify-content-between">
			<h1>Users</h1>

			<a href="{{ route('admin.image-types.create') }}">
				<button class="btn btn-teal">
					<i class="fa fa-plus"></i> New Image Type
				</button>
			</a>
		</div>

		@include ('partials.alerts')

		<table class="table">
			<thead>
				<th>Name</th>

				<th>Image Count</th>

				<th>Actions</th>

				<th>&nbsp</th>
			</thead>

			<tbody>
				@foreach ($types as $type)
					<tr>
						<td>
							<a href="{{ route('admin.image-types.edit', $type) }}">{{ $type->name }}</a>
						</td>

						<td>{{ $type->images()->count() }}</td>

						<td>
							<a href="{{ route('admin.image-types.edit', $type) }}">
								<i title="Edit" class="fa fa-edit"></i>
							</a>
						</td>

						<td>
							<form action="{{ route('admin.image-types.destroy', $type) }}" method="POST" onsubmit="if(!confirm('Are you sure? This is permanent.')) return false">
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
