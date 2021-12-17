# Date Input

Create a series of inline `input` elements for entering a date, with toggleable year, month, and day inputs.

```html
<x-govuk::date-input
    autocomplete="bday"
    hint="Enter the day, month, and year"
    id="birthday"
    is-title
    label="When is your birthday?"
    labelSize="xl"
    name="birthday"
    no-day
    no-month
    no-year
    :values="$values"
/>
```

## Props

| Name         | Type   | Default  | Description |
| ------------ | ------ | -------- | ----------- |
| autocomplete | string | on       | Whether the date inputs should be automatically filled |
| hint         | string | null     | A description of the input |
| id           | string | $name    | The ID of the input |
| isTitle      | bool   | false    | Whether the label is also the page title |
| label        | string | Required | The label for the form group |
| labelSize    | string | l        | How large the label should be |
| name         | string | Required | The name of the input |
| noDay        | bool   | false    | Hide the day input |
| noMonth      | bool   | false    | Hide the month input |
| noYear       | bool   | false    | Hide the year input |
| values       | array  | []       | The current values of the inputs |

### Autocomplete

The most common autocomplete modes are `bday` and `cc-exp`, with a suffix for day, month, and year.

This component will automatically add the appropriate suffix to each input.

### ID and Name

This component will automatically suffix the `id` and `name` of each input with `-day`. `-month`, and `-year`.

### Values

You may provide the current values of the inputs with a keyed array:

```php
[
    'day' => 31,
    'month' => 12,
    'year' => 2021,
]
```

## Also see

* [checkboxes](checkboxes.md)
* [hidden-input](hidden-input.md)
* [fieldset](fieldset.md)
* [file-upload](file-upload.md)
* [form](form.md)
* [radios](radios.md)
* [select](select.md)
* [text-input](text-input.md)
* [textarea](textarea.md)
