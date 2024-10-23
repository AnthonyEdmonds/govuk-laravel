# Service Navigation

Create a main navigation bar for your service.

```html
<x-govuk::service-navigation
    current-section="users"
    :links="[
        'Manage users' => 'users.index',
        'Sign out' => 'sign-out',
    ]"
    service-name="My service"
    service-route="home"
/>
```

This is included in the default page template `/resources/views/vendor/govuk/layout/header.blade.php` along with a `header`.

## Props

| Name           | Type   | Default | Description                             |
|----------------|--------|---------|-----------------------------------------|
| currentSection | string | null    | The currently active navigation section |
| links          | array  | []      | A keyed array of URLs                   |
| serviceName    | string | null    | The service name                        |
| serviceRoute   | string | null    | The route the service name links to     |

### Current section

If not provided, the current section is determined by looking at the current route name.

This will then be compared against either the `section` key of a link, or the first part of a link's `route`.

### Links

A keyed array, where the label is the key, and the value is the route name:

```php
[
    'Manage users' => 'users.index'
    'Sign out' => 'sign-out',
]
```

For conditional navigation you may provide a keyed array with the label as the key, a `route` key, and any other setting keys:

```php
[
    'Manage users' => [
        'blank' => true,
        'auth' => true,
        'can' => 'manage_users',
        'route' => 'users.index',
        'section' => 'users',
    ],
    'Sign out' => 'sign-out',
]
```

* The `auth` key will either only show when a User is signed in when set to `true`, or only shown when a User is not signed in when set to any other value
* The `blank` key will open the link in a new window
* The `can` key will perform an `@can` check against the current User
* The `section` key is used to determine whether the navigation section is currently active
   * If left blank, the section will be determined based on the first part of the route name
   * For example, `users.index` would be parsed as the `users` section

You may opt to include either `auth` or `can`, instead of using both.

## Also see

* [header](header.md)
* [footer](footer.md)
