# Configuration

## Config

The default configuration file is as follows:

```php
return [
    'forms' => [
        //
    ],
    
    'home' => [
        'label' => 'Dashboard',
        'route' => 'dashboard',
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

### Home

Breadcrumbs will always contain a link to the home page. This link can be customised by specifying a label and route.

### Parts

GOV.UK Laravel comes by default with parts for the following libraries:

* [404labfr\laravel-impersonate](https://github.com/404labfr/laravel-impersonate)
* [laracasts\flash](https://github.com/laracasts/flash)

You can enable them by setting the corresponding config value to `true`.

