# Text Input

Create an `input` element for entering new or existing passwords.

```html
<x-govuk::text-input
    hint="This value is case sensitive"
    id="password-id"
    inputmode="text"
    label="What is your password?"
    labelSize="l"
    name="password-name"
    new
    isTitle
    value="hunter2"
    width="10"
/>
```

This element is pre-wrapped in a `form-group` component, with `label`, `hint`, and `error` subcomponents.

## Props

| Name      | Type   | Default  | Description                                                                 |
|-----------|--------|----------|-----------------------------------------------------------------------------|
| hint      | string | null     | A descriptive hint for the input                                            |
| id        | string | $name    | The ID of the input                                                         |
| inputmode | string | text     | Which virtual keyboard mode to use                                          |
| label     | string | Required | The label of the input                                                      |
| labelSize | string | s        | The size of the label                                                       |
| name      | string | Required | The name of the input                                                       |
| new       | bool   | false    | Whether this input is for creating a new password                           |
| isTitle   | bool   | bool     | Whether the label is also the page title                                    |
| value     | string | null     | The current value of the input                                              |
| width     | int    | null     | How many characters you expect to be entered, one of: 2, 3, 4, 5, 10, or 20 |

## Subcomponents

* button
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
* [radios](radios.md)
* [search-bar](search-bar.md)
* [select](select.md)
* [textarea](textarea.md)
* [text-input](text-input.md)
* [time-input](time-input.md)
