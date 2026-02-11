# Extensions

The following additions have been made to the GOV.UK Design System, which you may opt to use when designing your own components and layouts.

## Buttons

Buttons may be styled as standard links elements using the `.app-button--as-link` class.

```html
<button class="govuk-button app-button--as-link">
    My link styled button
</button>
```

## Grid column widths

For easier programmatic layout, additional column widths have been added to fill the gaps:

* govuk-grid-column-two-quarters (as per `one-half`)

## Footer navigation margins

The footer navigation sections had an incorrect margin setting, which led them to break prematurely.

The margins have been replaced with padding of the same size.
