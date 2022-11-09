# Forms

A form builder is included for creating flexible GOV.UK Laravel forms.

These forms are self-contained, requiring no external logic, routes, or controllers.

## Setup

Each form consists of:
* a Form class which contains an array of Question classes
* a Laravel Model with the HasForm trait

### Routing

A route macro is provided to handle all forms. Add the following to your `routes/web.php` file:

```php
Route::govukLaravelForms();
```

You can then enter a form from one of three perspectives:

1. Starting a new form `MyModel::startFormRoute() OR route('forms.start', MyForm::key())`
2. Editing an existing Model `MyModel::editFormRoute($subject) OR route('forms.edit', [MyForm::key(), $subject->id])`

### Forms and Questions

The Form and Question classes contain a mixture of abstract and concrete methods.

* Completing the abstract methods should be sufficient for simple forms
* Overriding the concrete methods allows for greater customisation

Once created, register your Form class in the GOV.UK Laravel [config](configuration.md) file.

### Model

The Model represents the answers given by the end user and must have the `HasForm` trait.
