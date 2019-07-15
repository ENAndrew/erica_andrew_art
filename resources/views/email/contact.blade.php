@component('mail::message')

## New message from Erica Art Contact form:

@component('mail::panel')

From: {{ $data->name }}

At: <{{ $data->email }}>

Message: <br>

{{ $data->message }}

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
