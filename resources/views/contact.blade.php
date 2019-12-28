@extends ('layouts.app')

@section ('content')
	<div class="contact-wrapper">
		<section class="p-120">
			<div class="container">
				<h1 class="text-center text-caps">Contact Me</h1>

				<div class="row">
					<div class="col-md-4 d-flex justify-content-center align-items-center">
						<picture>
							<source srcset="/img/layout/Scarab_Sketch.webp" type="image/webp">
							<img class="img-fluid" src="/img/layout/Scarab_Sketch.jpg" alt="digital painting of a scarab beetle">
						</picture>
					</div>

					<div class="col-md-8">
						<p>I want to hear from you... drop me a line</p>

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

							<div class="g-recaptcha" data-sitekey="{{ config('recaptcha.key') }}"></div>

							<input type="button" class="btn btn-teal mt-3" value="Submit" onclick="this.disabled=true;this.value='Submitting, please wait...';this.form.submit();"></input>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection
