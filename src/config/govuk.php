<?php
// TODO Document
return [
    'forms' => [
        //
    ],

    'header' => [
        'links' => [
            'Sign out' => 'sign-out',
        ],
        'logo' => [
            'alt' => 'GOV.UK',
            'asset' => 'images/asset_name.jpg',
            'height' => 44,
        ],
        'route' => 'home',
        'service_name' => env('APP_NAME'),
    ],

    'home' => [
        'label' => 'Dashboard',
        'route' => 'dashboard',
    ],

    'parts' => [
        'laracasts_flash' => false,
        '404lab_impersonate' => false,
    ],
];
