@extends ('layouts.app')

@section ('content')
	<div class="traditional-gallery-wrapper wrapper">
		<image-gallery :images="{{ $images }}"></image-gallery>
	</div>
@endsection
