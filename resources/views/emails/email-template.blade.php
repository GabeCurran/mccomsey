@component('mail::message')
Hello, **User**!

Thank you for signing up for the **McComsey Automotive** website!

Please click the button below to verify your email address.

@component('mail::button', ['url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'])
    Verify Email
@endcomponent
@endcomponent