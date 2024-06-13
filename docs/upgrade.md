# Upgrading versions

The following sections contain guidance on how to upgrade your GOV.UK Laravel project between breaking versions.

Each section should be followed in sequence, starting with your current version and working up.

Guidance is shown from newest to oldest.

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
