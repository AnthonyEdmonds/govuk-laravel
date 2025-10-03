# Forms

Support is included for the [LaravelFormBuilder](https://github.com/AnthonyEdmonds/laravel-form-builder) library, which makes creating task-based forms simple.

GOV.UK style blades have been included which override the templates provided by LaravelFormBuilder.

To use them, simply publish the blades using:

```bash
php artisan vendor:publish --tag=govuk-form-builder
```

These will be output to `resources/vendor/form-builder/...` where you may customise them further, if needed.

For more information about using LaravelFormBuilder, refer to their documentation.
