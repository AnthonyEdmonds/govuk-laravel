# Forms

A form builder is included for creating flexible GOV.UK Laravel forms.

These forms are self-contained, requiring no external logic, routes, or controllers.

## Setup

Each form consists of:
* a Form class
* any number of Question classes
* a Laravel Model with the HasForm trait

## Forms

The Form and Question classes contain a mixture of abstract and concrete methods.

* Completing the abstract methods should be sufficient for simple forms
* Overriding the concrete methods allows for greater customisation

Once created, register your Form class in the GOV.UK Laravel [config](configuration.md) file.

### Subject / Model

A Model, referred to as `$subject`, is required to store the answers given by the end user.

This Model must use the `HasForm` trait.

### Start and Confirmation pages

Starting the Form will immediately go to the first Question, and submitting the Form will immediately exit the form.

To show a start or confirmation page, override the `startBlade()` and `confirmationBlade()` methods on the Form to return the associated blades.

### Exiting the Form

The Form will redirect to the base `/` route when exiting.

To exit to another endpoint, override the `exitRoute` method on the Form.

The `$subject` is passed to the method if it exists.

## Questions

### FormRequests

Questions require an associated FormRequest to handle any validation.

The Model is made available to each FormRequest via the `$this->subject` property.

## Routing

A route macro is provided to handle all forms. Add the following to your `routes/web.php` file:

```php
Route::govukLaravelForms();
```

You can then enter a form from one of three perspectives:

1. Starting a new form `MyModel::startFormRoute() OR route('forms.start', MyForm::key())`
2. Editing an existing Model `MyModel::editFormRoute($subject) OR route('forms.edit', [MyForm::key(), $subject->id])`
