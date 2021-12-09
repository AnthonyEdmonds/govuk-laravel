# Development Roadmap

My intention is to make GOV.UK Laravel match the Design System in terms of available components, and add Laravel specific functionality that speeds up development and reduces code repetition.

## Issues

* CSS does not wrap unrealistic long words
* A space after link components
* Fix notification banner colour
* Inline rules do not extend the Validator as expected, need to research

## Setup

* JS include
* CSS Colour variables
* Font asset
* Logo asset / placeholders

## GOV.UK Design System

* Checkboxes
* Date input
* File upload
* Footer and Header as components
* Inset text
* Panel
* Skip link
* Summary list
* Tabs

* Custom components
  * search-bar

## Laravel

* Document custom components / helpers
* Modify the Laravel error messages language file to match the examples in https://design-system.service.gov.uk/components/text-input/
* Add generic controllers, routes, and validation for common patterns
    * Single question
    * Confirm
* Automatic / implicit form session handling
* Add Questions type page
* Index / List page
* Config
    * Footer contents
    * Enable / disable impersonation and other page parts
* GovukPage
    * Start
    * Summary
    * Tasklist
* GovukQuestion
    * Checkboxes
    * Select

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
        * radios-input
        * search-bar
        * section-break
        * select-input
        * table
        * table-column
        * tag
        * text-area-input
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
    * Components
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
        * radios-input
        * search-bar
        * section-break
        * select-input
        * table
        * table-column
        * tag
        * text-area-input
        * text-input
        * ul
        * warning-text
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
    
