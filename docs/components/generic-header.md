# Header

Create a generic page header with a logo.

Official GOV.UK systems should use the [header](header.md) component.

```html
<x-govuk::header
    label="My label"
    logo-alt="Company name"
    logo-height="44"
    logo-image="{{ asset('images/asset_name.jpg') }}"
    logo-route="home"
/>
```

Navigation and service labelling are provided by the [service-navigation](service-navigation.md) component.

A generic-header is provided on the default page template `/resources/views/vendor/govuk/layout/header.blade.php` which can be configured from the `govuk` config file.

## Props

| Name       | Type   | Default  | Description                                    |
|------------|--------|----------|------------------------------------------------|
| label      | string | ''       | Text to display to the right of the logo       |
| logoAlt    | string | Required | The `alt` description for the logo             |
| logoHeight | int    | 44       | How tall the logo should be                    |
| logoImage  | string | Required | The path to the logo image                     |
| logoRoute  | string | Required | The route the logo should link to when pressed |

## Also see

* [footer](footer.md)
* [header](header.md)
* [service-navigation](service-navigation.md)
