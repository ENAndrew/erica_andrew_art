@extends ('layouts.admin')

@section ('content')
	<div class="category-index-wrapper">
		<div class="d-flex vertical-align justify-content-between">
			<h1>Users</h1>

			<a href="{{ route('admin.categories.create') }}">
				<button class="btn btn-teal">
					<i class="fa fa-plus"></i> New Category
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
				@foreach ($categories as $category)
					<tr>
						<td>
							<a href="{{ route('admin.categories.edit', $category) }}">{{ $category->name }}</a>
						</td>

						<td>{{ $category->images()->count() }}</td>

						<td>
							<a href="{{ route('admin.categories.edit', $category) }}">
								<i title="Edit" class="fa fa-edit"></i>
							</a>
						</td>

						<td>
							<form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="if(!confirm('Are you sure? This is permanent.')) return false">
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
