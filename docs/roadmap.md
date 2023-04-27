# Development Roadmap

My intention is to make GOV.UK Laravel match the Design System in terms of available components, and add Laravel specific functionality that speeds up development and reduces code repetition.

## Issues

* CSS does not wrap unrealistic long words
* Space after link components
* Inline rules do not extend the Validator as expected

## Enhancements

* Additional conditional input support for radios
* Index / List page
* Task List, once added as official component

# Road to v1

## Laravel

* Modify the Laravel error messages language file to match the examples in https://design-system.service.gov.uk/components/text-input/
* GovukPage
    * Feedback

## Tests to Backfill

* Helpers
    * GovukQuestion
* Questions
    * Question
* Views
    * Components
        * back
        * breadcrumbs
        * cookie-banner
        * details
        * grid-column
        * grid-row
        * phase-banner
        * section-break
        * summary-list
        * tag
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
    * Templates
      * Confirm
      * Confirmation
      * Custom
      * Error
      * Start
      * Summary
      * Template

## Docs to Backfill

* Helpers
    * GovukComponent
    * GovukForm
    * GovukPage
    * GovukQuestion
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
    * Templates
      * Confirm
      * Confirmation
      * Custom
      * Error
      * Question
      * Start
      * Summary
      * Template
