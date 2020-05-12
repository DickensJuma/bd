@component('mail::message')
# Hello,

@component('mail::panel')
## Name
{{$data['name']}}.

## Email
{{$data['email']}}.

## Message
{{$data['message']}}.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
