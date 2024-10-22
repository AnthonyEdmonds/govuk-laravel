# Button

Create a `button` element for use with a form. 

```html
<x-govuk::button
    as-link
    as-start-button
    controls="my-control"
    disabled
    form-action="$formAction"
    form-method="POST"
    hidden
    id="my-id"
    inverted
    label="My ARIA label"
    password
    prevent-double-click
    secondary
    :type="$buttonType"
    warning
>My Button</x-govuk::button>
```

## Props

| Name               | Type   | Default | Description                                                   |
|--------------------|--------|---------|---------------------------------------------------------------|
| asLink             | bool   | false   | Style the button as an `<a>` element                          |
| asStartButton      | bool   | false   | Style the button as "start"                                   |
| controls           | string | null    | The value of the `aria-controls` attribute                    |
| disabled           | bool   | false   | Whether the button is clickable                               |
| formAction         | string | null    | Overrides the form submit action                              |
| formMethod         | string | null    | Overrides the form submit method                              |
| hidden             | bool   | false   | Whether to set the `hidden` attribute                         |
| id                 | string | null    | Set an ID on the button                                       |
| inverted           | bool   | false   | Whether the button colour should be inverted                  |
| label              | string | null    | The value of the `aria-label` attribute                       |
| password           | bool   | false   | Whether this button is part of a password input               |
| preventDoubleClick | bool   | false   | Disable the button after it is clicked                        |
| secondary          | bool   | false   | Style the button as "secondary"                               |
| type               | string | null    | Apply the secondary, start, or warning styles with a variable |
| warning            | bool   | false   | Style the button as "warning"                                 |

### Type

Use the `type` prop when the style of button is programmatically determined.

## Also see

* [button-group](button-group.md)
* [form](form.md)
* [password](password.md)
