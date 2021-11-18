# GOV.UK Laravel
Use the GOV.UK Design System within the Laravel ecosystem, complete with Blade components and templates!

## Legal
GOV.UK Laravel is a community resource of the [GOV.UK Design System](https://design-system.service.gov.uk). The Design System team is not responsible for it and cannot support you with using it. Contact Anthony Edmonds directly if you need help, or you want to request a feature.

Published under the MIT licence.

## Installation

### What's in the box?

* [GOV.UK Design System](https://design-system.service.gov.uk) version 3.14
* [Inter](https://fonts.google.com/specimen/Inter), a free close replacement for the official GOV.UK font
* Laravel 8 Blade components of the GOV.UK Design System components
* Laravel 8 Blade templates of the main GOV.UK Design System pages
* PHP 8.0 Classes to support the creation of standard and custom pages

### Get the library

This library features two parts:

* PHP classes, components, and assets
* GOV.UK Frontend CSS and JS

Both parts can be installed using Composer:

`composer require anthonyedmonds\govuk-laravel`

If the NPM dependencies are not automatically installed, run:

`npm install govuk-frontend --save-dev`

### Publish the assets

Any of the following optional parts may be published via `php artisan vendor:publish`:

* Blade components and templates (/resources/views/vendor/govuk)
* Configuration file (/config/govuk.php)
* Fonts, images, and other assets (/resources/...)

### Hook up the CSS and JS

???

## Documentation

### Config

No configuration options are currently available.

### Creating standard pages

```php
return GovukPage::confirm(...);
return GovukPage::error(...);
return GovukPage::question(...);
return GovukPage::start(...);
return GovukPage::summary(...);
return GovukPage::tasklist(...);
```

### Building custom pages

```php
return GovukPage::blank(...);
return GovukPage::custom(...);
```

### Components

### Extensions and additions

#### Global colour settings

#### Override CSS classes

#### Buttons styled as links

## Contribution

Feel free to submit ideas and features as issues, and raise pull requests.
