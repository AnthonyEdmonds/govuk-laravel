# Footer

Create a language switching component.

```html
<x-govuk::languages
    current="en"
    :lanaguages="[
        'en' => 'English',
        'cy' => 'Cymraeg',
    ]"
    route="language.switch"
/>
```

This component is included as part of the default page template, and can be enabled by setting the `govuk.languages.route` configuration key.

## Props

| Name      | Type   | Default              | Description                                             |
|-----------|--------|----------------------|---------------------------------------------------------|
| current   | string | App::currentLocale() | The currently active language code                      |
| languages | array  | Required             | The list of languages available in code => label format |
| route     | string | Required             | The route used for handling language switches           |

### Route

The selected language code will be passed to the given route.

## Also see

* [service-navigation](service-navigation.md)
