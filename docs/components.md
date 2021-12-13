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

Please reference the [GOV.UK Design System components](https://design-system.service.gov.uk/components/) page for information on how and when to use certain components, and previews of the various options.

## GOV.UK Design System Components

* [a](components/a.md)
* [accordion](components/accordion.md)
* [back-link](components/back-link.md)
* [breadcrumbs](components/breadcrumbs.md)
* [button](components/button.md)
* [button-group](components/button-group.md)
* [cookie-banner](components/cookie-banner.md)
* [details](components/details.md)
* [error-summary](components/error-summary.md)
* [fieldset](components/fieldset.md)
* [form](components/form.md)
* [radios](components/radios.md)
* [summary-list](components/summary-list.md)

## Custom Components

* [grid-column](components/grid-column.md)
* [grid-row](components/grid-row.md)
* [form-group](components/form-group.md)
* [pagination](components/pagination.md)
