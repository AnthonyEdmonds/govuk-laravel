# Markdown

Renderers for the Markdown parser by [league/commonmark](https://github.com/thephpleague/commonmark/) are provided, which apply the GOV.UK CSS classes to content in Markdown format.

To enable these renderers, add the `GovukExtension` class to your `config/markdown.php` file:

```php
return [
    ...
    
    'extensions' => [
        AnthonyEdmonds\GovukLaravel\CommonMarkGovukExtension::class,
        League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension::class,
        League\CommonMark\Extension\Table\TableExtension::class,
    ],

    ...
];
```
