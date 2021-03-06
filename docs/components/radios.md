# Radios

Create an HTML radios input.

```html
<x-govuk::radios
    hint="Select an option from the list below"
    id="input-id"
    is-inline
    is-small
    is-title
    label="Which option applies?"
    label-size="l"
    name="input-name"
    :options="$options"
    value="selectedValue"
/>
```

Radios is pre-wrapped within a `form-group` and a `fieldset` component, with a `hint` and an `error` subcomponent.

Radios also features a leading `hidden` input which contains a null value, to catch incomplete values where they are not allowed to be null within a larger group.

## Props

| Name      | Type   | Default  | Description |
| --------- | ------ | -------- | ----------- |
| hint      | string | null     | A descriptive hint for the input |
| id        | string | $name    | The ID of the input element |
| isInline  | bool   | false    | Whether the radio buttons should be presented side by side |
| isSmall   | bool   | false    | Whether the radio buttons should be smaller |
| isTitle   | bool   | false    | Whether the label is also the page title |
| label     | string | Required | The main label of the input |
| labelSize | string | l        | How large the label should be |
| name      | string | Required | The name of the input element |
| options   | array  | []       | A keyed array |
| value     | string | null     | The value of the current selection | 

### Options

Radios can be configured in a range of different ways based on the array passed into `options`.

Each key of the `options` array is the value of the radio, with the label as the value:

```php
[
    'value-1' => 'Label One',
    'value-2' => 'Label Two',
    // More radio options...
]
```

Advanced radios can be created by passing a keyed array instead of a value, with a `hint` or `divider` key alongside a `label` key:

```php
[
    'value-1' => [
        'hint' => 'Select this option if you want to',
        'label' => 'Pick this option',
    ],
    'value-2' => [
        'divider' => true,
        'label' => 'or',
    ],
    // More radio options...
]
```

Inputs that should show when the option is selected can be set using the `inputs` key, providing an array of inputs to show:

```php
[
    'value-1' => [
        'hint' => 'Select this option if you want to',
        'label' => 'Pick this option',
        'inputs' => [
            [
                'label' => 'Phone number',
                'name' => 'phone',
            ],
            [
                'label' => 'Mobile number',
                'name' => 'mobile',
                'hint' => 'Without any prefixes'
            ],
        ],
    ],
    // More radio options...
]
```

You may provide any array keys that are compatible with the `text-input` component.

Support for other input types may be added in the future.

## Subcomponents

* input.radio

## Also see

* [checkboxes](checkboxes.md)
* [date-input](date-input.md)
* [fieldset](fieldset.md)
* [file-upload](file-upload.md)
* [form](form.md)
* [hidden-input](hidden-input.md)
* [select](select.md)
* [text-input](text-input.md)
* [textarea](textarea.md)
