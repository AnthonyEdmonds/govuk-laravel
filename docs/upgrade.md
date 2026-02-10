# Upgrading versions

The following sections contain guidance on how to upgrade your GOV.UK Laravel project between breaking versions.

Each section should be followed in sequence, starting with your current version and working up.

Guidance is shown from newest to oldest.

## Update to version 7.x from version 6.x

1. Update `govuk-frontend` to `^6` in your `package.json`
2. Remove the `$govuk-new-typography-scale` from your SCSS, if present
3. Replace any tags with the following colours:
   * light-blue => Pick another colour
   * turquoise => teal
   * pink => magenta

## Update to version 6.x from version 5.x

1. PHP 8.3 is now the minimum required
2. The inbuilt `Form` class has been removed in favour of a standalone library called [LaravelFormBuilder](https://github.com/AnthonyEdmonds/laravel-form-builder)
   1. If you want to continue using the inbuilt forms, You will need to replace your existing Form components with the LaravelFormBuilder ones
   2. Mechanically they are very similar, so it should be a case of switching classes and repointing any links to the new addresses
   3. Take advantage of the new task-based approach by grouping your form into many smaller tasks; your end-users will appreciate it!
3. The `GovukPage::question` and `GovukPage::questions` helpers now accept an array of settings, rather than the removed `Question` class
4. The `views/templates/question.blade.php` template will need to be updated if you have published it
5. The `type` of sub-inputs on `radios` and `checkboxes` questions has been moved from the outer array key to a specific property in the settings array
6. Added support for multiple `summary-list` actions
   * The `action` attribute has been changed to `actions`
   * You must now pass an array of arrays

## Update to version 5.x from version 4.x

1. If you have published the `resources/scss/govuk.variables.scss` file:
   1. Add `$govuk-new-typography-scale: true;` at the top of the file
   2. Add `$govuk-new-organisation-colours: true;` at the top of the file 
2. Change `app.scss` from `node_modules/govuk-frontend/dist/govuk/all` to `node_modules/govuk-frontend/dist/govuk/index.scss`
3. The `govuk` config file has changed to support the new `service-navigation` component
   1. Republish the config file, or manually edit it to get the latest keys
   2. Add your custom header logic into the config
      * The `link` key for conditional navigation has been changed to `route`
      * A `section` key has been added if your route names do not match the current route
   3. Remove `resources/vendor/govuk/layout/header.blade.php`, if published
   * The `header` component no longer supports navigation in favour of the `service-navigation` component
4. Replace any uses of the `type` property on the `button` component with `mode`
   * Type is now used only to set the native HTML attribute, with mode replacing it functionally
   * This also includes calls to `setButtonType` on pages and questions, where they have been overridden

## Update to version 4.x from version 3.x

1. All Form classes must update their signature for `checkAccess` to accept the subject as the first parameter
   1. `public function checkAccess(Model $subject): void`
2. If any of the following Form methods have been overridden, their signatures must be updated to include the subject as the first parameter:
   1. `summarySubmitLabel(Model $subject): string`
   2. `summaryBlade(Model $subject): ?string`
   3. `summaryCancelLabel(Model $subject): ?string`
   4. `summaryDraftLabel(Model $subject): ?string`

## Update to version 3.x from version 2.x

1. PHP 8.3 is now the minimum version
2. Laravel 11 is now the supported version

## Upgrade to version 2.x from version 1.x

1. Update `composer.json`:
   1. Change the version of `anthonyedmonds/govuk-laravel` to `^2`
   2. If your project uses the vendor view overrides, republish `layout/page.blade.php`
2. Update the `govuk-frontend` import in `package.json` to `^5`
3. Update the GOV.UK SCSS import in `app.scss` to `@import 'govuk-frontend/dist/govuk/all';`
4. Update the GOV.UK Colours SCSS import in `govuk-variables.scss` to `@import 'govuk-frontend/dist/govuk/helpers/_colour.scss';`
5. Update any custom code following the [GOV.UK upgrade guide](https://github.com/alphagov/govuk-frontend/releases/tag/v5.0.0)
6. Update any existing `task-list` components to the new official component
