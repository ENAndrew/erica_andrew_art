@include ('partials.start')
@include ('partials.header')

<div class="admin-wrapper wrapper my-5 py-5">
	<div class="container">
		<div class="row">
			@include ('admin.partials.sidebar')

			<div class="col-sm-9">
				@yield ('content')
			</div>
		</div>
	</div>
</div>

@include ('partials.end')
