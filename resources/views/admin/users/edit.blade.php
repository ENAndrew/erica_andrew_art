@extends ('layouts.admin')

@section ('content')
	<div class="user-edit-wrapper">
		@if ($user->id)
			<h1>Edit {{ $user->name }}</h1>
		@else
			<h1>Create New User</h1>
		@endif

		<form class="basic-form" role="form" action="/admin/users{{ $user->id ? '/'.$user->id : '' }}" method="POST" autocomplete="force-no">
			@csrf

			@if ($user->id)
				@method('PATCH')
			@endif

			@include ('partials.alerts')

			<div class="form-group form-row">
				<div class="col">
					<label for="first_name">First Name</label>

					<input class="form-control" type="text" name="first_name" value="{{ $user->first_name ?? old('first_name') }}">
				</div>

				<div class="col">
					<label for="last_name">Last Name</label>

					<input class="form-control" type="text" name="last_name" value="{{ $user->last_name ?? old('last_name') }}">
				</div>
			</div>

			<div class="form-group">
				<label for="email">Email</label>

				<input class="form-control" type="email" name="email" value="{{ $user->email ?? old('email') }}">
			</div>

			<div class="form-group">
                <label for="password">User Password:</label>

                <input class="form-control" type="password" name="password">
            </div>

            <div class="form-group">
                <label for="password">Confirm Password:</label>

                <input class="form-control" type="password" name="password_confirmation">
            </div>

            <button class="btn btn-primary" type="submit">Submit/Update User</button>
		</form>
	</div>
@endsection
