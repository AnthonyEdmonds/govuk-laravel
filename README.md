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

### Publish files

The following files may be published via `php artisan vendor:publish`:

| Tag          | Contents                            | Output path |
| ------------ | ----------------------------------- | ----------- |
| govuk-blade  | Blade components and page templates | /resources/views/vendor/govuk |
| govuk-config | Configuration file                  | /config/govuk.php |
| govuk-errors | Error pages for 401 through 503     | /resources/views/errors |

You should only need to publish these if you wish to make changes to the default components.

### Hook up the CSS, JS, and assets

???

Import the `govuk-laravel` scss styles in your main `resources/scss/app.scss` file:

```scss
@import '../../vendor/anthonyedmonds/govuk-laravel/src/resources/scss/govuk-laravel.scss';
```

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

#### Confirm Page

Show a confirmation page with a confirm and back button, with additional context via a content blade.

### Building custom pages

To create a blank page with custom content, you can call the `custom` method, passing in a blade that contains any or all of the following sections:

* Heading
* Content
* Aside

```php
return GovukPage::custom(...);
```

If you need to pass extra variables to the View, chain `->with(...)` onto the end of the call to `custom`.

You can also create a custom page using the `Page` class, which contains setters to fully construct a new page.

If you want to create a page from completely from scratch, you can extend `govuk::layout.page` or copy `resources/views/templates/template.blade.php` and modify it as required.

Be sure to pass any required variables to the blade, as per the `Page` class.

### Components

```html
<x-govuk::h1 size="m">My heading 1 text</x-govuk::h1>
<x-govuk::p bold lead small>My paragraph text</x-govuk::p>
<x-govuk::ul spaced bulleted>
    <li>...</li>
</x-govuk::ul>

<x-govuk::table
    caption="Users"
    :data="$users"
    empty-message="No Users with Roles found"
>
    <x-govuk::table-column label="Name">
        ~name
    </x-govuk::table-column>

    <x-govuk::table-column label="Roles">
        ~roles
    </x-govuk::table-column>

    <x-govuk::table-column label="" numeric hide="~isAdmin">
        <x-govuk::a href="~link">Manage<x-govuk::hidden> ~name</x-govuk::hidden></x-govuk::a>
    </x-govuk::table-column>
</x-govuk::table>
```

### Extensions and additions

#### Global colour settings

#### Override CSS classes

#### Buttons styled as links

## Contribution

Feel free to submit ideas and features as issues, and raise pull requests.
