# Button

Create a `button` element for use with a form. 

```html
<x-govuk::button
    as-link
    as-start-button
    disabled
    form-action="$formAction"
    form-method="POST"
    id="my-id"
    prevent-double-click
    secondary
    :type="$buttonType"
    warning
>My Button</x-govuk::button>
```

## Props

| Name               | Type   | Default | Description                                                   |
|--------------------| ------ |---------|---------------------------------------------------------------|
| asLink             | bool   | false   | Style the button as an `<a>` element                          |
| asStartButton      | bool   | false   | Style the button as "start"                                   |
| disabled           | bool   | false   | Whether the button is clickable                               |
| formAction         | string | null    | Overrides the form submit action                              |
| formMethod         | string | null    | Overrides the form submit method                              |
| id                 | string | null    | Set an ID on the button                                       |
| preventDoubleClick | bool   | false   | Disable the button after it is clicked                        |
| secondary          | bool   | false   | Style the button as "secondary"                               |
| type               | string | null    | Apply the secondary, start, or warning styles with a variable |
| warning            | bool   | false   | Style the button as "warning"                                 |

### Type

Use the `type` prop when the style of button is programmatically determined.

## Also see

* [button-group](button-group.md)
* [form](form.md)
