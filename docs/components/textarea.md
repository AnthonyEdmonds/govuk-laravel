# Textarea

Create a `textarea` element.

```html
<x-govuk::textarea
    autocomplete="on"
    count="50"
    hint="Enter a value between 30 - 50 characters"
    id="input-id"
    label="What is your name?"
    labelSize="l"
    name="input-name"
    placeholder="Your name..."
    rows="5"
    spellcheck="on"
    threshold="50"
    isTitle
    value="Bob Bobbington"
    words="50"
/>
```

This element is pre-wrapped with `count` and `form-group` components, with `label`, `hint`, `errors`, and `counter` subcomponents.

## Props

| Name         | Type   | Default  | Description |
| ------------ | ------ | -------- | ----------- |
| autocomplete | string | on       | Which autocomplete mode to use |
| count        | int    | null     | Show a character limit counter equal to `count` |
| hint         | string | null     | A descriptive hint for the textarea |
| id           | string | $name    | The ID of the textarea |
| label        | string | Required | The label of the textarea |
| labelSize    | string | s        | The size of the label |
| name         | string | Required | The name of the textarea |
| placeholder  | string | null     | The placeholder text to show |
| rows         | int    | 5        | The number of text rows to show |
| spellcheck   | string | false    | Which spellcheck mode to use |
| threshold    | int    | null     | Show the counter only after the threshold percentage is reached, such as `50` |
| isTitle      | bool   | bool     | Whether the label is also the page title |
| type         | string | text     | The type of textarea, such as `number` |
| value        | string | null     | The current value of the textarea |
| words        | int    | null     | Show a word limit counter equal to `words` |

## Subcomponents

* form-group.count
* form-group.counter
* form-group.error
* form-group.hint
* form-group.label

## Also see

* [checkboxes](checkboxes.md)
* [date](date.md)
* [fieldset](fieldset.md)
* [file-upload](file-upload.md)
* [form](form.md)
* [hidden-input](hidden-input.md)
* [radios](radios.md)
* [select](select.md)
* [text-input](text-input.md)
