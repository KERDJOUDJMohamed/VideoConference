@component('mail::message')
# Hello {{$username}}

Thank you for joining our plateform .


@component('mail::button', ['url' => 'https://usthb.alwaysdata.net/dashboard'])
Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
