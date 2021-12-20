# Footer

Create a page footer, complete with area for navigation, meta links, content licence, and logos.

```html
<x-govuk::footer
    licence-logo="{{ asset('images/ogl-logo.svg') }}"
    licence-logo-height="17"
    licence-logo-width="41"
    meta-heading="Support"
    :meta-links="$metaLinks"
    :navigation-links="$navigationLinks"
>
    <x-slot name="information">
        // Site and service details...
    </x-slot>

    <x-slot name="licence">
        // Licence details...
    </x-slot>

    <x-slot name="logos">
        // Logos...
    </x-slot>
</x-govuk::footer>
```

This component contains a lot of optional parts; given the complexity of this component, consider working on one part at a time.

A footer is provided on the default page template `/resources/views/vendor/govuk/layout/footer.blade.php`.

## Props

| Name              | Type   | Default | Description |
| ----------------- | ------ | ------- | ----------- |
| licenceLogo       | string | null    | The path to the licence logo |
| licenceLogoHeight | int    | null    | How tall the licence logo should be |
| licenceLogoWidth  | int    | null    | How wide the licence logo should be |
| metaHeading       | string | null    | The heading of the `meta` links section, for screen readers |
| metaLinks         | array  | []      | A keyed array |
| navigationLinks   | array  | []      | A keyed array |

### Meta

This prop accepts a keyed array, where the key is the label of the link, and the value is the route name.

```php
[
    'Help' => 'help.index',
    'Cookies' => 'privacy',
```

For conditional navigation you may provide a keyed array as the value, with a `route` key and other setting keys:

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

### Navigation

This prop accepts a keyed array, where the key is the heading label, and the value is a keyed array, where the key is the label for the link, and the value is the route name.

```php
[
    'Services and information' => [
        'Benefits' => 'benefits.index',
        'Information' => 'information.index',
    ],
    'Departments and policy' => [
        'Departments' => 'departments.index',
        'Policies' => 'policies.index',
    ],
]
```
    
You may display a set of links over several columns by specifying the `columns` key, and a `links` key:

```php
[
    'Services and information' => [
        'columns' => 2,
        'links' => [
            'Benefits' => 'benefits.index',
            'Information' => 'information.index',
            // Lots of links...
        ]
    ],
    'Departments and policy' => [
        'Departments' => 'departments.index',
        'Policies' => 'policies.index',
    ],
```

As with the `meta` prop, you may provide a keyed array as the value of a link for conditional navigation.

```php
[
    'Services and information' => [
        'columns' => 2,
        'links' => [
            'Benefits' => [
                'blank' => true,
                'can' => 'view_benefits',
                'route' => 'benefits.index',
            ],
            'Information' => 'information.index',
        ]
    ],
    'Departments and policy' => [
        'Departments' => [
            'blank' => true,
            'can' => 'view_departments',
            'route' => 'departments.index',
        ],
        'Policies' => 'policies.index',
    ],
]
```

## Slots

| Name        | Optional | Location                              | Usage |
| ----------- | -------- | ------------------------------------- | ----- |
| information | Yes      | Bottom-left corner                    | Descriptive text, such as service ownership |
| licence     | Yes      | Bottom-left corner, below information | A licence declaration for the page, with logo | 
| logos       | Yes      | Bottom-right corner                   | Company and service logos |

All of these slots are optional.

### Information

Any content passed into this slot will be wrapped in a `meta-custom` div.

You do not need to wrap any content passed into the slot, however you may include other tags.

### Licence

Any content passed into this slot will be wrapped in a `licence-description` div.

You do not need to wrap any content passed into the slot, however you may include other tags.

If set in the `licenceLogo` prop, a logo image will be displayed to the left of any content.

### Logos

Any content passed into this slot will be wrapped in a `meta-item` div.

You do not need to wrap any content passed into the slot, however you may include other tags.

## Subcomponents

* footer.licence
* footer.meta
* footer.navigation

## Also see

* [header](header.md)
