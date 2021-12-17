# Checkboxes

Create a checkboxes input, with almost identical options to the [radios](radios.md) component.

```html
<x-govuk::checkboxes
    hint="Select one or more options from the list below"
    id="input-id"
    is-small
    is-title
    label="Which options apply?"
    label-size="l"
    name="input-name"
    :options="$options"
    :value="$selectedValues"
/>
```

The only key differences between `checkboxes` and `radios` are:

* You may pass the `exclusive` key on an option in the `options` prop
* You may pass an array of values to the `value` prop
* You cannot use the `is-inline` prop

## Props

As per `radios`, except:

* You may pass `exclusive` as a key in the `options` prop
* You may pass an array to `value` for multiple selected checkboxes
* You cannot use `is-inline`

### Options

When `exclusive` is applied to a checkbox, it will de-select any other checkboxes. This is useful for a "none of the above" style option.

```php
[
    'value-1' => [
        'hint' => 'Only one of these options...',
        'label' => 'This one',
    ],
    'divider-1' => [
        'divider' => true,
        'label' => 'or',
    ],
    'value-2' => [
        'exclusive' => true,
        'hint' => '... can be selected',
        'label' => 'That one',
    ],
]
```

## Subcomponents

* input.checkbox

## Also see

* [date](date.md)
* [fieldset](fieldset.md)
* [file-upload](file-upload.md)
* [form](form.md)
* [hidden-input](hidden-input.md)
* [radios](radios.md)
* [select](select.md)
* [text-input](text-input.md)
* [textarea](textarea.md)
