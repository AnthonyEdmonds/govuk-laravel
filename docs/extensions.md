# Extensions

The following additions have been made to the GOV.UK Design System, which you may opt to use when designing your own components and layouts.

## Buttons

Buttons may be styled as standard links elements using the `.app-button--as-link` class.

```html
<button class="govuk-button app-button--as-link">
    My link styled button
</button>
```

## Colours

Colour override classes have been provided for every GOV.UK Design System colour under the `app-!-` namespace:

```html
<div class="
    app-!-background-red
    app-!-border-blue
    app-!-font-green
"></div>
```

## Grid Column Widths

For easier programmatic layout, additional column widths have been added to fill the gaps:

* govuk-grid-column-two-quarters (as per `one-half`)
