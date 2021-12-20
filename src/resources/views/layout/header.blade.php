<x-govuk::header
    :links="[
        'Sign out' => 'sign-out',
    ]"
    logo-alt="Company name"
    logo-route="home"
    logo-image="{{ asset('images/asset_name.jpg') }}"
    service-name="{{ env('APP_NAME', 'Welcome') }}"
/>
