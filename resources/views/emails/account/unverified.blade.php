@component('mail::message')
# Sorry!

@component('mail::panel')
    Your {{ $data['role'] }} account has been unverified! Please contact us on {{ env('MAIL_FROM_ADDRESS') }}
    for more information.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
