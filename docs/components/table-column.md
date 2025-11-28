# Table Column

Create a column as part of a `table` component.

```html
<x-govuk::table-column
    heading
    hide="~hidden"
    label="Name"
    numeric
    show="~shown"
>
    ~name
</x-govuk::table-column>
```

You may include any markup inside the column, or a simple placeholder key.

## Props

| Name    | Type   | Default        | Description                                      |
|---------|--------|----------------|--------------------------------------------------|
| heading | bool   | false          | Whether the cell is a heading                    |
| hide    | string | null           | Which placeholder to use for conditional hiding  |
| label   | string | <empty string> | The column heading                               |
| numeric | bool   | false          | Whether to right-align the column for numbers    |
| show    | string | null           | Which placeholder to use for conditional showing |

### Hide

You may hide cells by setting the `hide` prop with a placeholder.

```html
<x-govuk::table-column
    label="Bank ID"
    hide="~hidden"
>
    ~bank_id
</x-govuk::table-column>
```

If the provided placeholder evaluates to `true`, the cell value will not be rendered.

Values that are considered `true` include `true`, 1, or any non-empty string.

### Show

You may show cells by setting the `show` prop with a placeholder.

```html
<x-govuk::table-column
    label="Bank ID"
    show="~shown"
>
    ~bank_id
</x-govuk::table-column>
```

If the provided placeholder evaluates to `true`, the cell value will be rendered.

Values that are considered `true` include `true`, 1, or any non-empty string.

## Also see

* [table](table.md)
