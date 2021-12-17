# Select

Create a `<select>` input with an array of options.

```html
<x-govuk::select
    autocomplete="on"
    hint="Pick the option that best fits"
    id="input-id"
    label="Which option do you like?"
    label-size="l"
    name="input-name"
    :options="$options"
    is-title
    value="selectedValue"
/>
```

Select is pre-wrapped within a `form-group` component, with a `hint` and an `error` subcomponent.

## Props

| Name         | Type   | Default  | Description |
| ------------ | ------ | -------- | ----------- |
| autocomplete | string | on       | Which type of autocomplete to use |
| hint         | string | null     | A hint for the input |
| id           | string | $name    | The ID of the input |
| label        | string | Required | The main label of the input |
| labelSize    | string | s        | How large the label should be |
| name         | string | Required | The name of the input |
| options      | array  | []       | A keyed array |
| isTitle      | bool   | false    | Whether the label is also the page title |
| value        | string | null     | The currently selected value |

### Options

The keyed array passed into options should have the key as the value of the `option`, and the value as the label for the option.

```php
[
    'value-1' => 'Label one',
    'value-2' => 'Label two',
]
```

## Also see

* [checkboxes](checkboxes.md)
* [date-input](date-input.md)
* [fieldset](fieldset.md)
* [file-upload](file-upload.md)
* [form](form.md)
* [hidden-input](hidden-input.md)
* [radios](radios.md)
* [text-input](text-input.md)
* [textarea](textarea.md)
