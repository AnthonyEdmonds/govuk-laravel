<?php

return [
    'header' => [
        'label' => '',
        'links' => [],
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

    'favicons' => 'govuk::parts.favicons',

    'feedback' => [
        'header' => 'Help us improve this service',
        'description' => 'Tell us about your experience using this service.',
        'link_label' => 'Give us your feedback',
        'route' => null,
    ],

    'languages' => [
        'list' => [],
        'route' => null,
    ],

    'mail' => [
        'enabled' => true,
        'copyright' => env('APP_NAME'),
        'header' => [
            'title' => env('APP_NAME'),
            'logo' => null,
            'logo_alt' => 'GOV.UK',
            'logo_height' => null,
            'logo_width' => null,
        ],
        'footer' => [
            'logo' => null,
            'logo_alt' => 'GOV.UK',
            'logo_height' => null,
            'logo_width' => null,
        ],
    ],
];
