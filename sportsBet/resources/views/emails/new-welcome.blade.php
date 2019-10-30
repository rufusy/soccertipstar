@component('mail::message')
# Welcome

Dear {{ $first_name }} {{ $last_name }},<br>
Your new account has been created on {{ config('app.name') }}. Log in with your email address and this password {{ $password }}

@component('mail::button', ['url' => 'http://127.0.0.1:8000/login'])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
