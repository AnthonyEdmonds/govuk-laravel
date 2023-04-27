# Notification Banner

Create an informational banner of any colour, such as a completion or failure message. 

```html
<x-govuk::notification-banner
    colour="red"
    title="Danger"
>
    <x-govuk::notification-banner.heading>
        My emphasised banner text
    </x-govuk::notification-banner.heading>
    
    My regular notification content
</x-govuk::notification-banner>
```

## Props

| Name   | Type   | Default     | Description             |
| ------ | ------ | ----------- |-------------------------|
| colour | string | blue        | Any GOV.UK colour       |
| title  | string | Information | The title of the banner |

## Slots

| Name    | Usage                                   |
|---------|-----------------------------------------|
| default | The main content body of the banner     |

## Notification Banner Heading

You may add larger emphasised text to any notification banner with this subcomponent.
