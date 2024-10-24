# Header

Create a page header with a logo.

```html
<x-govuk::header
    logo-alt="Company name"
    logo-height="44"
    logo-image="{{ asset('images/asset_name.jpg') }}"
    logo-route="home"
/>
```

Navigation and service labelling are provided by the [service-navigation](service-navigation.md) component.

A header is provided on the default page template `/resources/views/vendor/govuk/layout/header.blade.php` which can be configured from the `govuk` config file.

## Props

| Name       | Type   | Default  | Description                                    |
|------------|--------|----------|------------------------------------------------|
| logoAlt    | string | Required | The `alt` description for the logo             |
| logoHeight | int    | 44       | How tall the logo should be                    |
| logoImage  | string | Required | The path to the logo image                     |
| logoRoute  | string | Required | The route the logo should link to when pressed |

## Also see

* [footer](footer.md)
* [service-navigation](service-navigation.md)
