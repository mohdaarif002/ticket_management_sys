@component('mail::message')
# Congratulations

You have been selected as {{$offer['user_type']}}

With login credentials as :-

username: {{$offer['login_credential_email']}}
password: {{$offer['login_credential_password']}}



Thanks,<br>
{{ config('app.name') }}
@endcomponent