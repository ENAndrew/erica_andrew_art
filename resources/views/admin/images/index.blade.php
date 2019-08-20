@extends ('layouts.admin')

@section ('content')
	<div class="image-index-wrapper">
		<image-editor :images="{{ $images }}" :types="{{ $types }}"></image-editor>
	</div>
@endsection
