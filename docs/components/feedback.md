# Feedback

Request feedback from users.

```html
<x-govuk::feedback
    header="Help us improve this service"
    description="Tell us about your experience using this service."
    link-label="Give us your feedback"
    route="my-route"
/>
```

This component is included as part of the default page template, and can be enabled by setting the `govuk.feedback.route` configuration key.

## Props

| Name        | Type   | Default                                           | Description                                                        |
|-------------|--------|---------------------------------------------------|--------------------------------------------------------------------|
| header      | string | Help us improve this service                      | The text of the feedback component header                          |
| description | string | Tell us about your experience using this service. | The text of the feedback component description                     |
| link_label  | string | ive us your feedback                              | The text of the link to give feedback                              |
| route       | string | Required                                          | The name of the route where users should be taken to give feedback |

## Also see

* [header](header.md)
* [service-navigation](service-navigation.md)
