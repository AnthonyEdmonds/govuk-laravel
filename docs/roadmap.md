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

## GOV.UK Design System

* [4.2.0 changes](https://github.com/alphagov/govuk-frontend/releases/tag/v4.2.0)
    * Add official pagination component
    * Check govuk-header__link--service-name
* [4.3.0 changes](https://github.com/alphagov/govuk-frontend/releases/tag/v4.3.0)
    * Use new override classes to apply static spacing (4.3.1 syntax)
    * Check govuk-header__navigation--no-service-name
    * Add hidden to the mobile menu button in the header component
* [4.4.0 changes](https://github.com/alphagov/govuk-frontend/releases/tag/v4.4.0)
    * Change the Button component's background and text colour
    * Configure components in JavaScript
* [4.5.0 changes](https://github.com/alphagov/govuk-frontend/releases/tag/v4.5.0)
    * Use summary cards to visually separate multiple summary lists on a single page
    * Search within accordion content on supporting browsers
    * Source maps for precompiled files

## Laravel

* Modify the Laravel error messages language file to match the examples in https://design-system.service.gov.uk/components/text-input/
* GovukPage
    * Confirmation
    * Feedback

## Tests to Backfill

* Helpers
    * GovukComponent
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
        
