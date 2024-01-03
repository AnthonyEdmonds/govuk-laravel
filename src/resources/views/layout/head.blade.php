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
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/favicon.ico') }}" />
    
    @vite('resources/js/app.js')
</head>
