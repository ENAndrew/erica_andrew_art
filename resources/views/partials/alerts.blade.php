@if ($errors->count())
    <div class="alert alert-danger" role="alert">
        <p><strong>Whoops! It looks like there was a problem:</strong></p>

        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        <p><strong>Success!</strong></p>

        <p>{!! Session::get('success') !!}</p>
    </div>
@endif

@if (Session::has('status'))
    <div class="alert alert-info" role="alert">
        <p>{!! Session::get('status') !!}</p>
    </div>
@endif

@if (Session::has('info'))
    <div class="alert alert-info" role="alert">
        <p>{!! Session::get('info') !!}</p>
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning" role="alert">
        <p><strong>Warning!</strong></p>

        <p>{!! Session::get('warning') !!}</p>
    </div>
@endif

@if (Session::has('danger'))
    <div class="alert alert-danger" role="alert">
        <p><strong>Danger!</strong></p>

        <p>{!! Session::get('danger') !!}</p>
    </div>
@endif
