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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
        'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'ipservice' => match (env('IPSERVICE')) {
        'iplocation' => \App\Services\Implementations\IpLocationService::class,
        'ipinfo' => \App\Services\Implementations\IpInfoService::class,

        default => null,
    },

    'apininjas' => [
        'endpoints' => [
            'quotes' => 'https://api.api-ninjas.com/v1/quotes',
        ],
        'api_key' => env('API_NINJAS_API_KEY'),
    ],

    'openweathermap' => [
        'endpoint' => 'https://api.openweathermap.org',
        'api_key' => env('OPENWEATHERMAP_API_KEY'),
    ],

    'ipstack' => [
        'endpoint' => 'http://api.ipstack.com',
        'api_key' => env('IPSTACK_API_KEY'),
    ],

];
