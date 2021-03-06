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

    'google' => [
        'client_id'     => '298180322997-72v5hijv9eiiu88tbf343kn71g1e5e9v.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect'      => env('APP_URL').'/auth/google/callback',
    ],
    
    'facebook'=>[
        'client_id'=>'4748680298526869',
        'client_secret'=>'0c8800fad5271a2ebb90a0918cc48f72',
        'redirect'=> env('APP_URL').'/auth/facebook/callback'
    ]

];
