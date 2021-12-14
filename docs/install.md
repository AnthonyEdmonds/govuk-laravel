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
| govuk-fonts  | Inter font and .scss file           | /resources/fonts and /resources/scss |
| govuk-scss   | Override file for custom colours    | /resources/scss |

Only publish `govuk-blade` if you wish to make changes to the components and templates.

## Hook up the CSS, JS, and assets

### JS

Add the GOV.UK Design System JavaScript to `resources/js/app.js` as normal.

```js
import { initAll } from 'govuk-frontend';
initAll();
```

### SCSS

Import the GOV.UK Design System followed by the GOV.UK Laravel scss styles in `resources/scss/app.scss` file.

If you want to override the default GOV.UK Design System colours and fonts, publish `govuk-scss`, amend the `govuk-variables.scss` file, and import it before both the GOV.UK Design System and GOV.UK Laravel.

```scss
@import 'govuk-variables.scss';
@import 'node_modules/govuk-frontend/govuk/all';
@import '../../vendor/anthonyedmonds/govuk-laravel/src/resources/scss/govuk-laravel.scss';
```

### Font

Publish `govuk-font` to copy [Inter](https://fonts.google.com/specimen/Inter), a free close replacement for the official GOV.UK font, and import the related `fonts.scss` file in `resources/scss/app.scss` before the GOV.UK Design System.

```scss
@import 'inter.scss';
// GOV.UK and other imports...
```

Make sure that the font files are copied across in `webpack.mix.js`:

```js
mix.options()
    // Other commands...
    .copyDirectory(
        'resources/fonts',
        'public/fonts'
    );
```
