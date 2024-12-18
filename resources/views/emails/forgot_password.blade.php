@component('mail::message')

Hi, {{ $user->name }}

<p>Please klik button for reset your password</p>

@component('mail::button', ['url' => url('reset/'.$user->remember_token)])
Reset your password
@endcomponent

Thanks, <br>

@endcomponent