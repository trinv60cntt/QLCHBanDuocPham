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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '3249836351913920',
        'client_secret' => 'ee4a4e4b76e3ac3939a7f1aaca7fb6c2',
        'redirect' => 'http://localhost:8000/login-checkout/callback'
    ],


    'google' => [
        'client_id' => '122829892320-s4it40cnup73dp4b53o7p3b54q2euvam.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/google/callback'
    ],
];
