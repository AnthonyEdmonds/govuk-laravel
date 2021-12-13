# Component Name

Create a `<p>` tag with the appropriate classes already applied.

```html
<x-govuk::p
    bold
    lead
    small
>My paragraph text</x-govuk::p>
```

Only either `lead` or `small` can be active at a time.

## Props

| Name  | Type | Default | Description |
| ----- | ---- | ------- | ----------- |
| bold  | bool | false   | Make the text bold |
| lead  | bool | false   | Make the text large |
| small | bool | false   | Make the text small |
