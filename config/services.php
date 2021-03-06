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

    'mercadopago' => [
        'base_uri' => env('MERCADOPAGO_BASE_URI'),
        'public_key' => env('MERCADOPAGO_PUBLIC_KEY'),
        'access_token' => env('MERCADOPAGO_ACCESS_TOKEN'),
        'base_currency' => 'cop',
        'class' => App\Services\MercadoPagoService::class,
    ],

    'currency_conversion' => [
        'base_uri' => env('CURRENCY_CONVERSION_BASE_URI'),
        'api_key' => env('CURRENCY_CONVERSION_API_KEY'),
        'class' => App\Services\CurrencyConversionService::class,
    ],

    'paypal' => [
        'base_uri' => env('PAYPAL_BASE_URI'),
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET'),
        'class' => App\Services\PaypalService::class,
        'plans' => [
            'monthly' => env('PAYPAL_MONTHLY_PLAN'),
            'yearly' => env('PAYPAL_YEARLY_PLAN'),
        ]
    ],

    'payu' => [
        'base_uri' => env('PAYU_BASE_URI'),
        'account_id' => env('PAYU_ACCOUNT_ID'),
        'merchant_id' => env('PAYU_MERCHANT_ID'),
        'key' => env('PAYU_KEY'),
        'secret' => env('PAYU_SECRET'),
        'base_currency' => 'cop',
        'class' => App\Services\PayUService::class,
    ],

    'stripe' => [
        'base_uri' => env('STRIPE_BASE_URI'),
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'class' => App\Services\StripeService::class,
        'plans' => [
            'monthly' => env('STRIPE_MONTHLY_PLAN'),
            'yearly' => env('STRIPE_YEARLY_PLAN'),
        ]
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
