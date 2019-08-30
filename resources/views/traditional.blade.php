@extends ('layouts.app')

@section ('content')
	<div class="traditional-gallery-wrapper">
		<parallax src="/img/layout/paint_bg.jpg" :speed="0.02">
			<image-gallery :images="{{ $images }}"></image-gallery>
		</parallax>
	</div>
@endsection
