# Development Roadmap

My intention is to make GOV.UK Laravel match the Design System in terms of available components, and add Laravel specific functionality that speeds up development and reduces code repetition.

## Issues

* CSS does not wrap unrealistic long words
* Space after link components
* Inline rules do not extend the Validator as expected

## Enhancements

* Additional conditional input support for radios
* Add generic controllers, routes, and validation for common patterns
    * Single question
    * Confirm
* Automatic / implicit form session handling
* Index / List page

# Road to v1

## GOV.UK Design System

* Checkboxes
* Date input
* File upload
* Footer and Header as components
* Panel
* Skip link
* Tabs

## Laravel

* Modify the Laravel error messages language file to match the examples in https://design-system.service.gov.uk/components/text-input/
* Config
    * Footer contents
    * Enable / disable impersonation and other page parts
* GovukPage
    * Start
    * Summary
    * Tasklist
* GovukQuestion
    * Checkboxes 

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
        * icon
        * notification-banner
        * p
        * pagination
        * phase-banner
        * radios
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

* Config
* Helpers
    * GovukComponent
    * GovukForm
    * GovukPage
    * GovukQuestion
* Pages
    * Page
* Providers
    * GovukServiceProvider
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
    
