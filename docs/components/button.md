# Button

Create a `button` element for use with a form. 

```html
<x-govuk::button
    as-link
    disabled
    prevent-double-click
    secondary
    start
    :type="$buttonType"
    warning
>My Button</x-govuk::button>
```

## Props

| Name               | Type   | Default | Description |
| ------------------ | ------ | ------- | ----------- |
| asLink             | bool   | false   | Style the button as an `<a>` element |
| disabled           | bool   | false   | Whether the button is clickable |
| preventDoubleClick | bool   | false   | Disable the button after it is clicked |
| secondary          | bool   | false   | Style the button as "secondary" |
| start              | bool   | false   | Style the button as "start" |
| type               | string | null    | Apply the secondary, start, or warning styles with a variable |
| warning            | bool   | false   | Style the button as "warning" |

### Type

Use the `type` prop when the style of button is programmatically determined.

## Also see

* [button-group](button-group.md)
* [form](form.md)
