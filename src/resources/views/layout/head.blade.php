<head>
    <meta charset="utf-8" />
    <title>
        @isset($title)
            {{ $title }} -
        @endif
        {{ env('APP_NAME', 'Welcome') }}
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#0b0c0c" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}" />

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicon/apple-icon-57x57.png') }}" />
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicon/apple-icon-60x60.png') }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon/apple-icon-72x72.png') }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon/apple-icon-76x76.png') }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon/apple-icon-114x114.png') }}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon/apple-icon-120x120.png') }}" />
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/apple-icon-144x144.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon/apple-icon-152x152.png') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-icon-180x180.png') }}" />
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicon/android-icon-192x192.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32nr.png') }}" />
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon/favicon-96x96nr.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16nr.png') }}" />

    <meta name="msapplication-TileColor" content="#1d70b8" />
    <link rel="manifest" href="{{ asset('images/favicon/manifest.json') }}" />
    <meta name="msapplication-TileImage" content="{{ asset('images/favicon/ms-icon-144x144nr.png') }}" />
</head>
