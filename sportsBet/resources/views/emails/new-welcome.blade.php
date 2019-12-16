Dear {{ $name }},<br><br>
Your new account has been created on {{ config('app.name') }}.<br>
User name: {{ $user_email}}<br>
Password: {{ $password}}<br><br>
<button><a href="http://127.0.0.1:8000/login">Login</a></button><br><br>
If the link above will not work copy paste this url in the browser: {{ route('login')}}<br><br>
Thanks,<br>
{{ config('app.name') }}