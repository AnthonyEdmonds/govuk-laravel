# Pages

## Creating standard pages

```php
return GovukPage::confirm(...);
return GovukPage::error(...);
return GovukPage::question(...);
return GovukPage::start(...);
return GovukPage::summary(...);
return GovukPage::tasklist(...);
```

### Confirm Page

Show a confirmation page with a confirm and back button, with additional context via a content blade.

## Building custom pages

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
