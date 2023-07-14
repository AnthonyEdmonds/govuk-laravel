# Back Link

Provide an immediate exit button to allow users to exit the page, hiding any sensitive information.

```html
<x-govuk::exit-this-page
    href="{{ route('my-route') }}"
    label="Exit this page"
/>
```

## Props

| Name  | Type   | Default                       | Description              |
|-------|--------|-------------------------------|--------------------------|
| href  | string | https://www.bbc.co.uk/weather | The URL to navigate to   |
| label | string | Exit this page                | The label for the button |
