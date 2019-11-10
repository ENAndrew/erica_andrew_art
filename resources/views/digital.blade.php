@extends ('layouts.app')

@section ('content')
	<div class="digital-gallery-wrapper wrapper">
		<image-gallery :images="{{ $images }}"></image-gallery>
	</div>
@endsection
