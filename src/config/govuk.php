<?php

return [
    /* The icon to show in the top-left corner */
    'icon' => [
        'alt' => 'My GOV.UK System',
        'asset' => 'images/logo.svg',
        'route' => 'dashboard',
    ],
    
    /* Which links to show in the top navigation bar, along with any permissions checks */
    'navigation' => [
        'Sign out' => [
            // 'can' => 'permission name'
            'route' => 'sign-out'
        ]
    ]
];
