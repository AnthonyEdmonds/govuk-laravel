# Form Group

Wrap an `input` inside a `form-group` to provide adequate spacing and error visibility. 

```html
<x-govuk::form-group
    name="input_name"
>
    // An input...
</x-govuk::form-group>
```

All `input` components provided by GOV.UK Laravel are pre-wrapped.

## Props

| Name | Type   | Default  | Description |
| ---- | ------ | -------- | ----------- |
| name | string | Required | The `name` of the wrapped input element |

## Also see

* [checkboxes](checkboxes.md)
* [file-upload](file-upload.md)
* [form](form.md)
* [hidden-input](hidden-input.md)
* [radios](radios.md)
* [select](select.md)
* [text-input](text-input.md)
* [textarea](textarea.md)
