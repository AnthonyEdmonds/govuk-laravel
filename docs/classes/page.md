# Page

This class handles the functionality shared between GovukLaravel pages.

You may use the `GovukPage` helper to quickly create standard pages, then chain methods to further customise it.

When creating fully customised pages, you may either instantiate a new `Page` class, or use the `GovukPage::custom(...)` method.

This class implements the Laravel `View` contract, and may be used as expected, such as being returned directly from a controller.

## Setting and getting properties

Methods exist to set any of the Page properties, such as `->setTitle(...)`.

Retrieving properties is done via the `->toArray()` method.

## Constants

Constants have been provided for properties which may only be set to specific values, such as button types and methods.
