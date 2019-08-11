@extends ('layouts.admin')

@section ('content')
	<div class="category-edit-wrapper">
		@if ($category->id)
			<h1>Edit {{ $Category->name }}</h1>
		@else
			<h1>Create New Category</h1>
		@endif

		<form class="basic-form" role="form" action="/admin/categories{{ $category->id ? '/' . $category->id : '' }}" method="POST" autocomplete="force-no">
			@csrf

			@if ($category->id)
				@method('PATCH')
			@endif

			@include ('partials.alerts')

			<div class="form-group">
				<label for="name">Name</label>

				<input id="name" class="form-control" type="text" name="name" value="{{ $category->name ?? old('name') }}">
			</div>

			<div class="form-group">
				<label for="slug">Slug</label>

				<slug value="{{ $category->slug ?? old('slug') }}" dependent="name"></slug>
			</div>

            <button class="btn btn-primary" type="submit">Submit/Update Category</button>
		</form>
	</div>
@endsection
