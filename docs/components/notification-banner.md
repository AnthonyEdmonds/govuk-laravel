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
| colour | string | dark-blue   | The colour of the banner |
| title  | string | Information | The title of the banner |

### Colour

Colour can be any valid GOV.UK colour as defined in the scss.
