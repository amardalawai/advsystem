<?php

return [

    /*
      |--------------------------------------------------------------------------
      | Third Party Services
      |--------------------------------------------------------------------------
      |
      | This file is for storing the credentials for third party services such
      | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
      | default location for this type of information, allowing packages
      | to have a conventional place to find your various credentials.
      |
     */

    'mailgun' => [
        'domain' => '',
        'secret' => '',
    ],
    'mandrill' => [
        'secret' => '',
    ],
    'ses' => [
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],
    'stripe' => [
        'model' => App\User::class,
        'key' => '',
        'secret' => '',
    ],
    'google' => [
        'client_id' => '865274412604-2ee5aqhpukr6ah70cukij0qr8ct6mm3c.apps.googleusercontent.com',
        'client_secret' => 'VzbjIAMw-Ibb1H_XYeWcqNdD',
        'redirect' => 'http://localhost/savjikitchen/public/auth/google/callback',
    ],
    'facebook' => [
        'client_id' => '246263435539826',
        'client_secret' => 'b2ce960a93441b36d98292d761c15996',
        'redirect' => 'http://localhost/savjikitchen/public/auth/google/callback',
    ],
];
