@component('mail::message')
# Hello,

@component('mail::panel')
    A new user has signed up!!
@endcomponent

## Name
{{$data['name']}}

## Type
{{$data['type']}}

## Phone
{{$data['phone']}}

## Email
{{$data['email']}}

@if ($data['type'] == 'wholesaler' || $data['type'] == 'retailer')
## Shop Name
{{$data['shop_name']}}
@endif

## Location
{{$data['location_name']}}, {{$data['county']}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
