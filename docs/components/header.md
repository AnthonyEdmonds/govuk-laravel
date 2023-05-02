# Header

Create a page header, complete with logo, name, and navigation links.

```html
<x-govuk::header
    :links="[
        'Manage users' => route('users.index'),
        'Sign out' => route('sign-out'),
    ]"
    logo-alt="Company name"
    logo-height="44"
    logo-image="{{ asset('images/asset_name.jpg') }}"
    logo-link="{{ route('home') }}"
    service-name="My service"
/>
```

A header is provided on the default page template `/resources/views/vendor/govuk/layout/header.blade.php`.

## Props

| Name        | Type   | Default                     | Description                                        |
|-------------|--------|-----------------------------|----------------------------------------------------|
| links       | array  | []                          | A keyed array of URLs                              |
| logoAlt     | string | $serviceName                | The `alt` description for the logo                 |
| logoHeight  | int    | 44                          | How tall the logo should be                        |
| logoImage   | string | Required                    | The path to the logo image                         |
| logoLink    | string | config(silverowl.home.link) | The link that the logo should link to when pressed |
| serviceName | string | null                        | The service name                                   | 

### Links

A keyed array, where the label is the key, and the value is the link:

```php
[
    'Manage users' => route('users.index'),
    'Sign out' => route('sign-out'),
]
```

For conditional navigation you may provide a keyed array with the label as the key, a `link` key, and any other setting keys:

```php
[
    'Manage users' => [
        'blank' => true,
        'auth' => true,
        'can' => 'manage_users',
        'link' => route('users.index'),
    ],
    'Sign out' => route('sign-out'),
]
```

* The `auth` key will either only show when a User is signed in when set to `true`, or only shown when a User is not signed in when set to any other value
* The `blank` key will open the link in a new window
* The `can` key will perform an `@can` check against the current User

You may opt to include either `auth` or `can`, instead of using both.

## Also see

* [footer](footer.md)
