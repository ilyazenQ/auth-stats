@component('mail::message')
# Welcome aboard!

Please click the button below to verify your email address.

@component('mail::button', ['url' => route('verification.verify', [
    'id' => $user->getKey(),
    'hash' => sha1($user->getEmailForVerification())
])])
Verify Email Address
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
