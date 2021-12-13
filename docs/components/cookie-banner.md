# Cookie Banner

Show a banner with a message and buttons, commonly used for cookie notices:

```html
<x-govuk::cookie-banner
    label="Cookies on my system"
>
    <x-govuk::p>My cookie warning messages.</x-govuk::p>
    
    <x-slot name="buttons">
        <x-govuk::a
            as-button
            href="{{ route('accept-cookies') }}"
        >Accept cookies</x-govuk::a>
        <x-govuk::a
            as-button
            href="{{ route('accept-cookies') }}"
        >Reject cookies</x-govuk::a>
    </x-slot>
</x-govuk::cookie-banner>
```

If you wish to submit a cookie decision using anything other than a `get` request, wrap the banner in a `form` element and use a `button` element instead of a link.

## Props

| Name  | Type   | Default               | Description |
| ----- | ------ | --------------------- | ----------- |
| label | string | Cookies on `app_name` | The main heading of the cookie banner |

## Slots

| Name    | Location               | Usage |
| ------- | ---------------------- | ----- |
| $slot   | Below the main label   | An explanation of the cookies used on this service |
| buttons | Below the main content | For accept, reject, or hide buttons |

## Also see

* [a](a.md)
* [button](button.md)
* [form](form.md)
* [p](p.md)
