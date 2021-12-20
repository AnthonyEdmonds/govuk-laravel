# Header

Create a page header, complete with logo, name, and navigation links.

```html
<x-govuk::header
    :links="[
        'Manage users' => 'users.index',
        'Sign out' => 'sign-out',
    ]"
    logo-alt="Company name"
    logo-route="home"
    logo-image="{{ asset('images/asset_name.jpg') }}"
    logo-height="44"
    service-name="My service"
/>
```

A header is provided on the default page template, which can be modified in `/resources/views/vendor/govuk/layout/header.blade.php`.

## Props

| Name        | Type   | Default      | Description |
| ----------- | ------ | ------------ | ----------- |
| links       | array  | []           | A keyed array |
| logoAlt     | string | $serviceName | The `alt` description for the logo |
| logoRoute   | string | home         | The route that the logo should link to when pressed |
| logoImage   | string | Required     | The path to the logo image |
| logoHeight  | int    | 44           | How tall the logo should be | 
| serviceName | string | null         | The service name | 

### Links

A keyed array, where the label is the key, and the value is the route:

```php
[
    'Manage users' => 'users.index',
    'Sign out' => 'sign-out',
]
```

For conditional navigation provide a keyed array as the value, with a `route` key and other setting keys:

```php
[
    'Manage users' => [
        'blank' => true,
        'can' => 'manage_users',
        'route' => 'users.index',
    ],
    'Sign out' => 'sign-out',
]
```

* The `blank` key will open the link in a new window.
* The `can` key will perform an `@can` check against the current User.

## Also see

* [footer](footer.md)
