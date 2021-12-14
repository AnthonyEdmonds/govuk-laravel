# Component Name

Create an informational banner of any colour, such as a completion or failure message. 

```html
<x-govuk::notification-banner
    colour="red"
    title="Danger"
>
    // Notification content...
</x-govuk::notification-banner>
```

## Props

| Name   | Type   | Default     | Description |
| ------ | ------ | ----------- | ----------- |
| colour | string | blue        | Any GOV.UK colour |
| title  | string | Information | The title of the banner |
