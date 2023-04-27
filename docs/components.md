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

Input and form elements take advantage of Laravel's inbuilt validation and error handling, retrieving error messages and previously entered values where possible. 

## Typography
* [a](components/a.md)
* [caption](components/caption.md)
* [h1](components/h1.md)
* [h2](components/h2.md)
* [h3](components/h3.md)
* [h4](components/h4.md)
* [hidden](components/hidden.md)
* [inset-text](components/inset-text.md)
* [ol](components/ol.md)
* [p](components/p.md)
* [ul](components/ul.md)

## Layout
* [footer](components/footer.md)
* [grid-column](components/grid-column.md)
* [grid-row](components/grid-row.md)
* [header](components/header.md)

## Forms and inputs

* [checkboxes](components/checkboxes.md)
* [date-input](components/date-input.md)
* [fieldset](components/fieldset.md)
* [file-upload](components/file-upload.md)
* [form](components/form.md)
* [form-group](components/form-group.md)
* [hidden-input](components/hidden-input.md)
* [radios](components/radios.md)
* [select](components/select.md)
* [text-input](components/text-input.md)
* [textarea](components/textarea.md)

## Other components

* [accordion](components/accordion.md)
* [back-link](components/back-link.md)
* [breadcrumbs](components/breadcrumbs.md)
* [button](components/button.md)
* [button-group](components/button-group.md)
* [cookie-banner](components/cookie-banner.md)
* [details](components/details.md)
* [error-summary](components/error-summary.md)
* [notification-banner](components/notification-banner.md)
* [pagination](components/pagination.md)
* [panel](components/panel.md)
* [phase-banner](components/phase-banner.md)
* [section-break](components/section-break.md)
* [skip-link](components/skip-link.md)
* [summary-card](components/summary-card.md)
* [summary-list](components/summary-list.md)
* [table](components/table.md)
* [tabs](components/tabs.md)
* [tag](components/tag.md)
* [warning-text](components/warning-text.md)

## Custom components
* [search-bar](components/search-bar.md)
* [time-input](docs/components/time-input.md)
