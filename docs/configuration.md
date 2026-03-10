# Configuration

## Installation

The default configuration file can be found in `src/config/govuk.php`.

You can publish the configuration file by following the [installation guide](install.md).

## Keys

### Header

If you are using the provided page layout, you can configure the header and navigation using these keys:

| Key                 | Type   | Usage                                                         |
|---------------------|--------|---------------------------------------------------------------|
| header.links        | array  | See [service-navigation](../components/service-navigation.md) |
| header.logo.alt     | string | The text description if your service logo cannot be found     |
| header.logo.asset   | string | The literal path to your service logo asset                   |
| header.logo.height  | int    | The height of your service logo in pixels                     |
| header.route        | string | The route name for your service logo hyperlink                |
| header.service_name | string | The service name, defaulted to your `APP_NAME`                |

### Home

Breadcrumbs will always contain a link to the home page. This link can be customised by specifying a label and route.

### Parts

GOV.UK Laravel comes by default with parts for the following libraries:

* [404labfr\laravel-impersonate](https://github.com/404labfr/laravel-impersonate)
* [laracasts\flash](https://github.com/laracasts/flash)

You can enable them by setting the corresponding config value to `true`.
