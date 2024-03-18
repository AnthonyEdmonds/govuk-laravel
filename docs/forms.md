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

When a form exists in the session, the start page will allow the user to restore their progress.

### Summary page

A summary page will be shown prior to submitting the form.

Users may be returned to the summary page after submission to allow editing.

To provide a read-only view of the summary page, override the `canEdit()` method on the Form with your logic to determine whether the subject is editable.

### Exiting the Form

The Form will redirect to the base `/` route when exiting.

To exit to another endpoint, override the `exitRoute` method on the Form.

The `$subject` is passed to the method if it exists.

### Saving drafts

Some forms require different saving modes, such as "publish" and "draft".

You can enable a second button on the form summary page by returning a string label from the `submitDraftLabel` method.

The `submitDraft` method can then be overridden to add the draft behaviour.

Primary or "publish" behaviour should always be kept in the `submitForm` method.

## Questions

### FormRequests

Questions require an associated FormRequest to handle any validation.

The Model is made available to each FormRequest via the `$this->subject` property.

### Skippable

Set this const to `true` to show the skip button which links to the `skip` method on the Question.

### Loops

Set this const to `true` to return to the question after submitting the Question. Useful for questions such as file uploads where you want to allow multiple selection.

Ensure you provide an exit from the loop using the `skippable` functionality.

### Withs

Some questions require additional information to be passed to the blade.

You can override the `withs` method to provide a keyed array, where the key is the name of the variable on the blade.

## Routing

A route macro is provided to handle all forms. Add the following to your `routes/web.php` file:

```php
Route::govukLaravelForms();
```

You can then enter a form from one of three perspectives:

1. Starting a new form `MyModel::startFormRoute() OR route('forms.start', MyForm::key())`
2. Editing an existing Model `MyModel::editFormRoute($subject) OR route('forms.edit', [MyForm::key(), $subject->id])`

## HasForm

### canSubmit

Each model can override the `canSubmit` method to control whether the model can be submitted.

Return `true` from the method to allow submission, or return a message as a string to tell the user what went wrong. 
