# Layout

Every GOV.UK page extends a standard two-thirds / one-third style page layout.

There are several sections that your blade templates may utilise to layout content:

| Section     | Location              | Position                       | Main uses |
| ----------- | --------------------- | ------------------------------ | --------- |
| heading     | Below main navigation | Before breadcrumbs             | Notifications and warnings |
| before-main | Two-thirds area       | After the title, unless hidden | Custom content for GovukPages |
| main        | Two-thirds area       | After before-main              | Primary page content and template content |
| after-main  | Two-thirds area       | After main                     | Custom content for GovukPages |
| aside       | One-thirds sidebar    | On the right                   | Search, actions, notes |

It is worth noting that if the main content features a single question, where the question's label is the page title, the before-main slot will be above the page title.

## GovukPages and content blades

When passing a blade into certain GovukPages, your blade may define any of the sections except for `main`, as the `main` section is used for the template content.

Confirmation and Custom pages are the exception, where you may define any section.

```php
// my-custom-content.blade.php
@section('heading')
    ...
@endsection

@section('before-main')
    ...
@endsection

@section('after-main')
    ...
@endsection

@section('aside')
    ...
@endsection

// When calling the content...
GovukPage::custom('My title')->content('my-custom-content');
```
