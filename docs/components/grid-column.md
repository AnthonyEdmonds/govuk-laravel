# Grid Column

Create a column for layout as per the GOV.UK layouts style.

```html
<x-govuk::grid-column
    width="two-thirds"
>
    //  and other content
</x-govuk::grid-column>
```

A `grid-column` should be wrapped inside a `grid-row`.

## Props

| Name  | Type   | Default  | Description |
| ----- | ------ | -------- | ----------- |
| width | string | Required | The width of the column, such as `one-third` |

## Also see

* [grid-row](grid-row.md)
