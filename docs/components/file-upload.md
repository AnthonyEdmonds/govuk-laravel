# File Upload

Create an `input` element of `file` type, along with an accepted list of file formats to accept.

```html
<x-govuk::text-input
    accept="image/*,.pdf"
    hint="Select an image or PDF"
    id="input-id"
    label="Which file would you like to upload?"
    labelSize="l"
    name="input-name"
    isTitle
/>
```

This element is pre-wrapped with `form-group` components, with `label`, `hint`, and `errors` subcomponents.

## Props

| Name      | Type   | Default  | Description                              |
|-----------|--------|----------|------------------------------------------|
| accept    | string | *        | Which file or mime types to accept       |
| hint      | string | null     | A descriptive hint for the input         |
| id        | string | $name    | The ID of the input                      |
| label     | string | Required | The label of the input                   |
| labelSize | string | null     | The size of the label                    |
| name      | string | Required | The name of the input                    |
| isTitle   | bool   | bool     | Whether the label is also the page title |

## Subcomponents

* form-group.error
* form-group.hint
* form-group.label

## Also see

* [checkboxes](checkboxes.md)
* [date-input](date-input.md)
* [fieldset](fieldset.md)
* [file-upload](file-upload.md)
* [form](form.md)
* [hidden-input](hidden-input.md)
* [password](password.md)
* [radios](radios.md)
* [search-bar](search-bar.md)
* [select](select.md)
* [textarea](textarea.md)
* [time-input](time-input.md)
