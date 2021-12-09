# Components

Every GOV.UK Design System component has been carefully recreated as a Laravel Blade component.

You can add them directly to your Blade files under the `x-govuk::` namespace:

```html
<x-govuk::p>A simple paragraph</x-govuk::p>

<x-govuk::section-break visible />

<x-govuk::ul spaced bullets>
    <li>Something more advanced!</li>
</x-govuk::ul>
```

Each component supports every option provided by the GOV.UK Design System via an attribute or as part of a passed in array; please see each individual component's documentation for its options.

## GOV.UK Design System Components

* [Radios](components/radios.md)
* [Summary List](components/summary-list.md)

## Custom Components

* [Pagination](components/pagination.md)
