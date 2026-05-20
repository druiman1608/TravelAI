<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'stripe' => [
        'secret' => env('STRIPE_SECRET'),
    ],

    'resend' => [
        'api_key' => env('RESEND_API_KEY'),
        'from'    => env('RESEND_FROM', 'TravelAI <onboarding@resend.dev>'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
    ],

    'groq' => [
        'key' => env('GROQ_API_KEY'),
    ],

];