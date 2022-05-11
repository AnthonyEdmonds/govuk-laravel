# Forms

* Access a route that accesses a form
* Retrieves place in form
* Has optional start and submission page flags
* Is tied to a model?
* Has methods / events for tying into form actions
* Force forms to be modelled around a model

## Routes

Use the `govukForm` macro to add routes for the form:

```php
Route::prefix('/my-form')
    ->name('my-form.')
    ->group(function () {
        Route::govukForm(MyForm::class);
    });
```

Routes will be automatically added for each of the features enabled on the form.

| Page         | Route            | Method | Name         | Optional |
| ------------ | ---------------- | ------ | ------------ | -------- |
| Start        | /start           | get    | start        | Yes      |
| Task List    | /tasks           | get    | tasks        | Yes      |
| Summary      | /summary         | get    | summary      | Yes      |
| Submit       | /submit          | post   | submit       | No       |
| Confirmation | /confirmation    | get    | confirmation | Yes      |
| Create       | /{step-key}      | get    | create       | No       |
| Store        | /{step-key}      | post   | store        | No       |
| Edit         | /{step-key}/edit | get    | edit         | No       |
| Update       | /{step-key}/edit | put    | update       | No       |

Movement internally within the form is handled automatically by the `FormController`.

1. Users start by navigating to the `start` route
2. Users are taken to the `tasks` route, and shown each section they need to complete
3. Users `create` answers to each step in a section, before being returned to the `tasks` page
4. Once all sections are complete they are taken to the `summary` page
5. Users may review and `edit` their answers.
6. Users may then `submit` the form
7. Users are shown the `confirmation` page

The start, task list, summary, and confirmation pages can be toggled by setting the matching flag when defining the `Form` class.
