# Markdown

A set of blades and a theme compatible with Laravel's markdown mailer are available for use.

To use them, simply set the `govuk.mail.enabled` config setting to `true`.

You can further customise the mails with your own header and footer logos using the config file.

Otherwise, you may continue to use Laravel markdown mailables as normal.

## Components

Extra components have been added to provide more GOV.UK styling options.

### Tag

You can add tags to your mailables using:

```html
<x-mail::tag colour="primary" label="Info" />
```

Colour options are provided for all of the GOV.UK colours.

### Phase Banner

You can add a phase banner to your mailables using:

```html
<x-mail::phase-banner>
    <x-mail::tag colour="primary" label="Info" />
    There is some information here.
</x-mail::phase-banner>
```

## Inconsistencies

E-mail formatting is still quite inconsistent between clients.

Elements should display closely to their browser counterparts.

Be aware that some inconsistencies may appear regardless.

## Also see

* [Configuration](configuration.md)
