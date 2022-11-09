# Configuration

## Config

The default configuration file is as follows:

```php
return [
    'forms' => [
        //
    ],
    
    'parts' => [
        'laracasts_flash' => false,
        '404lab_impersonate' => false,
    ],
];
```

### Forms

You can register forms built using the GOV.UK Laravel Form by listing them in the array.

```php
'forms' => [
    MyForm::class,
    MyOtherForm::class,
],
```

### Parts

GOV.UK Laravel comes by default with parts for the following libraries:

* [404labfr\laravel-impersonate](https://github.com/404labfr/laravel-impersonate)
* [laracasts\flash](https://github.com/laracasts/flash)

You can enable them by setting the corresponding config value to `true`.

