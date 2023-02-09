<?php

return [
    'default' => env('URL_SHORTENER_DRIVER', 'hide_uri'),

    'shorteners' => [

        'bit_ly' => [
            'driver' => 'bit_ly',
            'domain' => env('URL_SHORTENER_PREFIX', 'bit.ly'),
            'token' => env('URL_SHORTENER_API_TOKEN')
        ],

        'tiny_url' => [
            'driver' => 'tiny_url',
            'domain' => env('URL_SHORTENER_PREFIX', 'tinyurl.com'),
            'token' => env('URL_SHORTENER_API_TOKEN')
        ],

        'shorte_st' => [
            'driver' => 'shorte_st',
            'token' => env('URL_SHORTENER_API_TOKEN')
        ],

        'is_gd' => [
            'driver' => 'is_gd',
            'statistic' => env('URL_SHORTENER_ANALYTICS', false)
        ],

        'cutt_ly' => [
            'driver' => 'cutt_ly',
            'token' => env('URL_SHORTENER_API_TOKEN')
        ],

        'firebase' => [
            'driver' => 'firebase',
            'domain' => env('URL_SHORTENER_PREFIX'),
            'token' => env('URL_SHORTENER_API_TOKEN'),
            'suffix' => env('URL_SHORTENER_SUFFIX', 'UNGUESSABLE')
        ],

        'hide_uri' => [
            'driver' => 'hide_uri'
        ],

        'ouo_io' => [
            'driver' => 'ouo_io',
            'token' => env('URL_SHORTENER_API_TOKEN')
        ]
    ]
];
