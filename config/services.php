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
        'client_id' => '802698017369807',
        'client_secret' => '02dbd0e8f74243dfb61304ad12349702',
        'redirect' => 'https://nhathuocso2.herokuapp.com/login-checkout/callback'
    ],


    'google' => [
        'client_id' => '122829892320-s4it40cnup73dp4b53o7p3b54q2euvam.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://nhathuocso2.herokuapp.com/google/callback'
    ],
];
