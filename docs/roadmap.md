# Development Roadmap

My intention is to make GOV.UK Laravel match the Design System in terms of available components, and add Laravel specific functionality that speeds up development and reduces code repetition.

## Issues

* CSS does not wrap unrealistic long words
* Space after link components
* Inline rules do not extend the Validator as expected

## Enhancements

* Additional conditional input support for radios
* Automatic / implicit form session handling
* Index / List page
* Task List, once added as official component

# Road to v1

## Laravel

* Modify the Laravel error messages language file to match the examples in https://design-system.service.gov.uk/components/text-input/
* GovukPage
    * Confirmation
    * Feedback

## Tests to Backfill

* Helpers
    * GovukComponent
    * GovukForm
    * GovukPage
    * GovukQuestion
* Pages
    * Page
* Questions
    * Question
* Views
    * Components
        * form-group
            * count
            * counter
            * error
            * hint
            * label
        * input
            * radio
        * pagination
            * length-aware
            * simple
        * table
            * body
            * cell
            * header
            * row
        * a
        * accordion
        * back
        * breadcrumbs
        * button
        * button-group
        * cookie-banner
        * details
        * error-summary
        * fieldset
        * form
        * form-group
        * grid-column
        * grid-row
        * h1
        * h2
        * h3
        * h4
        * hidden
        * hidden-input
        * notification-banner
        * p
        * pagination
        * phase-banner
        * section-break
        * select
        * summary-list
        * table
        * table-column
        * tag
        * textarea
        * text-input
        * ul
        * warning-text
    * Layout
        * Foot
        * Footer
        * Head
        * Header
        * Page
    * Parts
        * Back
        * Breadcrumbs
        * Caption
        * Content
        * Errors
        * Flash Messages
        * Impersonation
        * Testing
        * Title

## Docs to Backfill

* Helpers
    * GovukComponent
    * GovukForm
    * GovukPage
    * GovukQuestion
* Pages
    * Page
* Questions
    * Question
* Views
    * Errors
    * Parts
        * Back
        * Breadcrumbs
        * Caption
        * Content
        * Errors
        * Flash Messages
        * Impersonation
        * Testing
        * Title
        