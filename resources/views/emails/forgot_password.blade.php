@component('mail::message')

Hi, {{ $user->name }}. Forgot Password?

<p>It Happen</p>

@component('mail::button', ['url' => url('reset/'.$user->remember_token)])
Reset your password
@endcomponent

Thanks, <br>
{{ config('app.name') }}

@endcomponent