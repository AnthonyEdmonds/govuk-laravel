# Installation

## Get the library

This library features two parts:

* PHP classes, components, and assets
* GOV.UK Frontend CSS and JS

Both parts can be installed using Composer:

```bash
composer require anthonyedmonds/govuk-laravel
```

If the NPM dependencies are not automatically installed, run:

```bash
npm install govuk-frontend --save-dev
```

## Service Provider

The GOV.UK Laravel service provider will automatically be loaded.

You can manually load the service provider by adding it to your `config/app.php`:

```php
'providers' => [
    // ...
    AnthonyEdmonds\GovukLaravel\Providers\GovukServiceProvider::class,
],
```

## Publish files

Several options are available via `php artisan vendor:publish`.

All essential files are provided in `govuk-core`.

### govuk-core

This command will publish the config, error pages, scss, and layout files:

* /config/govuk.php
* /resources/scss
* /resources/views/errors
* /resources/views/layout/header.blade.php
* /resources/view/layout/footer.blade.php

### govuk-font

This command will publish Inter font and its .scss file:

* /resources/fonts
* /resources/scss

### govuk-blade

This command will publish the Blade components and page templates, if you need to customise them:

* /resources/views/vendor/govuk

You will need to either republish or manually update the templates if they are updated in the base GOV.UK Laravel repository. 

### govuk-mail

This command will publish theme files to make your Laravel Mailables use the GOV.UK theme.

* /resources/views/vendor/mail/html/themes/default.css
* /resources/views/vendor/mail/html/tag.blade.php

### govuk-form-builder

If you are using the [Laravel Form Builder](https://github.com/AnthonyEdmonds/laravel-form-builder) library, you can use this tag to publish GOV.UK styled views for it.

* /resources/views/vendor/form-builder

### laravel-find

If you are using the [Laravel Find](https://github.com/AnthonyEdmonds/laravel-find/) library, you can use this tag to publish GOV.UK styles views for it.

* /resources/views/vendor/laravel-find

## Hook up the CSS, JS, and assets

### JS

GOV.UK Laravel supports [Vite](https://laravel.com/docs/10.x/vite), which replaces the older Laravel Mix.

Add the GOV.UK Laravel JavaScript, and GOV.UK Design System JavaScript and SCSS to `/resources/js/app.js`.

```js
import { initAll } from 'govuk-frontend';
import '../scss/app.scss';
import '../../vendor/anthonyedmonds/govuk-laravel/src/resources/js/govuk-laravel.js';

initAll();
```

The `govuk-laravel.js` file contains overrides to improve some of the GOV.UK Design System behaviour, however it may be omitted if you prefer the default experience.

### SCSS

Import the GOV.UK Design System followed by the GOV.UK Laravel scss styles in `/resources/scss/app.scss` file.

If you want to override the default GOV.UK Design System colours and fonts, amend `/resources/scss/govuk-variables.scss` file and import it before both the GOV.UK Design System and GOV.UK Laravel.

```scss
@import 'govuk-variables.scss';
@import 'node_modules/govuk-frontend/dist/govuk/index.scss';
@import '../../vendor/anthonyedmonds/govuk-laravel/src/resources/scss/govuk-laravel.scss';
```

### Font

Publish `govuk-font` to copy [Inter](https://fonts.google.com/specimen/Inter), a free close replacement for the official GOV.UK font, and import the related `fonts.scss` file in `/resources/scss/app.scss` before the GOV.UK Design System.

```scss
@import 'inter.scss';
// GOV.UK and other imports...
```
