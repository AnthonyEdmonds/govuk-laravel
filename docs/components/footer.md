# Footer

Create a page footer, complete with area for navigation, meta links, content licence, and logos.

```html
<x-govuk::footer
    
>
</x-govuk::footer>
```

Given the complexity of this component, consider implementing one section at a time.

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

```php
[
    'Help' => 'help.index',
    'Cookies' => 'privacy',
    'Support' => [
        'blank' => true,
        'can' => 'contact_support',
        'route' => 'support',
    ],
]
```

### Navigation

```php
[
    'Services and information' => [
        'Benefits' => 'benefits.index',
        'Support' => 'support',
    ],
    
    'Services and information' => [
        'columns' => 2,
        'links' => [
            'Benefits' => 'benefits.index',
            'Vehicles' => 'vehicles.index',
            ],
        ],
    ],
    
    'Departments and policy' => [
    'columns' => 2,
        'links' => [
            'Benefits' => 'benefits.index',
            'Vehicles' => [
                'blank' => true,
                'can' => 'manage_vehicles'
                'route' => 'vehicles.index',
            ],
        ],
    ],
]
```

## Slots

| Name        | Location | Usage |
| ----------- | -------- | ----- |
| information | Bottom-left corner | Descriptive text, such as service ownership |
| licence     | Bottom-left corner, below information | A licence declaration for the page, with logo | 
| logos       | Bottom-right corner | Company and service logos |

## Subcomponents

* footer.licence
* footer.meta
* footer.navigation

## Also see

* [header](header.md)
