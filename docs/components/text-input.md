# Text Input

Create an `input` element of varying forms.

```html
<x-govuk::text-input
    autocomplete="on"
    extraSpacing="false"
    hint="Enter a value between 30 - 50 characters"
    id="input-id"
    inputmode="text"
    label="What is your name?"
    labelSize="l"
    name="input-name"
    placeholder="Your name..."
    prefix="£"
    spellcheck="on"
    suffix="per item"
    isTitle
    type="text"
    value="Bob Bobbington"
    width="10"
/>
```

This element is pre-wrapped with `count` and `form-group` components, with `label`, `hint`, `errors`, and `counter` subcomponents.

## Props

| Name          | Type   | Default  | Description                                                                 |
|---------------|--------|----------|-----------------------------------------------------------------------------|
| autocomplete  | string | on       | Which autocomplete mode to use                                              |
| extraSpacing  | bool   | false    | Whether to put extra spacing between characters                             |
| hint          | string | null     | A descriptive hint for the input                                            |
| id            | string | $name    | The ID of the input                                                         |
| inputmode     | string | text     | Which virtual keyboard mode to use                                          |
| label         | string | Required | The label of the input                                                      |
| labelSize     | string | s        | The size of the label                                                       |
| name          | string | Required | The name of the input                                                       |
| placeholder   | string | null     | The placeholder text to show                                                |
| prefix        | string | null     | Text to show to the left of the input                                       |
| spellcheck    | string | false    | Which spellcheck mode to use                                                |
| suffix        | string | null     | Text to show to the right of the input                                      |
| isTitle       | bool   | bool     | Whether the label is also the page title                                    |
| type          | string | text     | The type of input, such as `number`                                         |
| value         | string | null     | The current value of the input                                              |
| width         | int    | null     | How many characters you expect to be entered, one of: 2, 3, 4, 5, 10, or 20 |

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
* [radios](radios.md)
* [search-bar](search-bar.md)
* [select](select.md)
* [textarea](textarea.md)
* [time-input](time-input.md)
