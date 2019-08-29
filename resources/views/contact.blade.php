@extends ('layouts.app')

@section ('content')
	<div class="contact-wrapper">
		<section class="p-120">
			<div class="container">
				<h1 class="text-center text-caps">Contact Me</h1>

				@include ('partials.alerts')

				<form class="basic-form contact-form" method="POST" action="/contact">
					@csrf

					<div class="form-group">
						<label for="name">Your Name:</label>

						<input type="text" class="form-control" name="name" value="{{ old('name') }}">
					</div>

					<div class="form-group">
						<label for="email">Email:</label>

						<input type="email" class="form-control" name="email" value="{{ old('email') }}">
					</div>

					<div class="form-group">
						<label for="message">Message:</label>

						<textarea class="form-control" rows="6" name="message">{{ old('message') }}</textarea>
					</div>

					<div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>

					<button type="submit" class="btn btn-teal">Submit</button>
				</form>
			</div>
		</section>
	</div>
@endsection
