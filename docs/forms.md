# Forms

* Access a route that accesses a form
* Retrieves place in form
* Has optional start and submission page flags
* Is tied to a model?
* Has methods / events for tying into form actions
* Force forms to be modelled around a model

## Routes

Generic routes are added to Laravel that allow any created forms to be accessed:

| Page         | Route                       | Method | Name                    |
| ------------ | --------------------------- | ------ | ----------------------- |
| Start        | /{form-key}/start           | get    | govuk-form.start        |
| Task List    | /{form-key}/tasks           | get    | govuk-form.tasks        |
| Summary      | /{form-key}/summary         | get    | govuk-form.summary      |
| Submit       | /{form-key}/submit          | post   | govuk-form.submit       |
| Confirmation | /{form-key}/confirmation    | get    | govuk-form.confirmation |
| Create       | /{form-key}/{step-key}      | get    | govuk-form.create       |
| Store        | /{form-key}/{step-key}      | post   | govuk-form.store        |
| Edit         | /{form-key}/{step-key}/edit | get    | govuk-form.edit         |
| Update       | /{form-key}/{step-key}/edit | put    | govuk-form.update       |

Movement internally within the form is handled automatically by the `FormController`.

1. Users start by navigating to the `start` route
2. Users are taken to the `tasks` route, and shown each section they need to complete
3. Users `create` answers to each step in a section, before being returned to the `tasks` page
4. Once all sections are complete they are taken to the `summary` page
5. Users may review and `edit` their answers.
6. Users may then `submit` the form
7. Users are shown the `confirmation` page

The start, task list, summary, and confirmation pages can be toggled by setting the matching flag when defining the `Form` class.
