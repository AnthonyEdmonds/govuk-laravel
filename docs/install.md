# Installation

## Get the library

This library features two parts:

* PHP classes, components, and assets
* GOV.UK Frontend CSS and JS

Both parts can be installed using Composer:

`composer require anthonyedmonds\govuk-laravel`

If the NPM dependencies are not automatically installed, run:

`npm install govuk-frontend --save-dev`

## Publish files

The following files may be published via `php artisan vendor:publish`:

| Tag          | Contents                            | Output path |
| ------------ | ----------------------------------- | ----------- |
| govuk-blade  | Blade components and page templates | /resources/views/vendor/govuk |
| govuk-config | Configuration file                  | /config/govuk.php |
| govuk-errors | Error pages for 401 through 503     | /resources/views/errors |

`govuk-config` and `govuk-errors` should be published.

Only publish `govuk-blade` if you wish to make changes to the components and templates.

## Hook up the CSS, JS, and assets

???

Import the `govuk-laravel` scss styles in your main `resources/scss/app.scss` file:

```scss
@import '../../vendor/anthonyedmonds/govuk-laravel/src/resources/scss/govuk-laravel.scss';
```
