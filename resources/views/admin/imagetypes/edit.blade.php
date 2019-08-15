@extends ('layouts.admin')

@section ('content')
	<div class="image-type-edit-wrapper">
		@if ($type->id)
			<h1>Edit {{ $type->name }}</h1>
		@else
			<h1>Create New Image Type</h1>
		@endif

		<form class="basic-form" role="form" action="/admin/imagetypes{{ $type->id ? '/' . $type->id : '' }}" method="POST" autocomplete="force-no">
			@csrf

			@if ($type->id)
				@method('PATCH')
			@endif

			@include ('partials.alerts')

			<div class="form-group">
				<label for="name">Name</label>

				<input id="name" class="form-control" type="text" name="name" value="{{ $type->name ?? old('name') }}">
			</div>

			<div class="form-group">
				<label for="slug">Slug</label>

				<slug value="{{ $type->slug ?? old('slug') }}" dependent="name"></slug>
			</div>

            <button class="btn btn-primary" type="submit">Submit/Update Image Type</button>
		</form>
	</div>
@endsection
