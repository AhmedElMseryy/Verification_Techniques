<?php

return [

    // VERIFICATION TECHNIQUES
    // 'default' => without any verification
    // 'email' => with email verification using signed URLS (register)
    // 'cvt' => with email verification using custom verification token (register)
    // 'passwordless' => passwordless authentication (login)
    // 'otp' => OTP authentication (login)


    'way' => 'otp',

    // OTP PROVIDERS
    // 'twilio' OR 'vonage'
    'otp_provider' => 'vonage'

];
