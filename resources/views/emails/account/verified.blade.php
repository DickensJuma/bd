@component('mail::message')
# Congratulation!

@component('mail::panel')
    Your {{ $data['role'] }} account has been verified!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
