# Configuration

## Installation

The default configuration file can be found in `src/config/govuk.php`.

You can publish the configuration file by following the [installation guide](install.md).

## Keys

### Header

If you are using the provided page layout, you can configure the header and navigation using these keys:

| Key                 | Type   | Usage                                                                      |
|---------------------|--------|----------------------------------------------------------------------------|
| header.label        | string | The text to used next to your logo, if needed                              |
| header.links        | array  | See [service-navigation](../components/service-navigation.md)              |
| header.logo.alt     | string | The text description if your service logo cannot be found                  |
| header.logo.asset   | string | The name of a route, an asset path, or a literal path to your service logo |
| header.logo.height  | int    | The height of your service logo in pixels                                  |
| header.route        | string | The route name for your service logo hyperlink                             |
| header.service_name | string | The service name, defaulted to your `APP_NAME`                             |

### Home

Breadcrumbs will always contain a link to the home page. This link can be customised by specifying a label and route.

### Parts

GOV.UK Laravel comes by default with parts for the following libraries:

* [404labfr\laravel-impersonate](https://github.com/404labfr/laravel-impersonate)
* [laracasts\flash](https://github.com/laracasts/flash)

You can enable them by setting the corresponding config value to `true`.

### Favicons

The `favicons` key allows you to provide the name of the blade which contains your list of favicons.

### Feedback

Customise the [feedback](https://design-system.service.gov.uk/components/feedback/) component on the page template, which is presented just above the page footer.

| Key                  | Type   | Usage                                                              |
|----------------------|--------|--------------------------------------------------------------------|
| feedback.header      | string | The text of the feedback component header                          |
| feedback.description | string | The text of the feedback component description                     |
| feedback.link_label  | string | The text of the link to give feedback                              |
| feedback.route       | string | The name of the route where users should be taken to give feedback |

The page template will not show the feedback component when the `route` is set to `null`.

This does not interfere with the [feedback component](../components/feedback.md) itself, which you may use directly.

### Languages

Customise the languages component on the page template, which is presented within the [service navigation](../components/service-navigation.md) component.

| Key             | Type   | Usage                                                   |
|-----------------|--------|---------------------------------------------------------|
| languages.list  | array  | The list of available languages in code => label format |
| languages.route | string | The endpoint which controls language switching          |

The page template will not show the languages component when the `route` is set to `null`.

This does not interfere with the [languages component](../components/languages.md) itself, which you may use directly.
                                           |