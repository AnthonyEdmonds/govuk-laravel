# Rules

Each rule can be used as a macro, or as an instance.

## Dates

The `date-input` component is slightly unusual from a Laravel validation point of view, as it is submitted in three parts.

These rules check to make sure that the specified date exists, and only need to be applied to one part of the `date-input` validation.

Note that this rule only works with the full three-part `date-input` component.

### OnDate

Ensure that the submitted date is on a particular day.

```php
Rule::onDate(Carbon::now())
// or
new OnDate(Carbon::now())
```

### BeforeDate

Ensure that the submitted date is before a particular day.

```php
Rule::beforeDate(Carbon::now())
// or
new BeforeDate(Carbon::now())
```

### AfterDate

Ensure that the submitted date is after a particular day.

```php
Rule::afterDate(Carbon::now())
// or
new AfterDate(Carbon::now())
```

### OnOrBeforeDate

Ensure that the submitted date is on or before a particular day.

```php
Rule::onOrBeforeDate(Carbon::now())
// or
new OnOrBeforeDate(Carbon::now())
```

### OnOrAfterDate

Ensure that the submitted date is on or after a particular day.

```php
Rule::onOrAfterDate(Carbon::now())
// or
new OnOrAfterDate(Carbon::now())
```

## Word count

If you are using an input with a words counter, you may wish to ensure that the limit is enforced server-side with some rules.

### MaxWords

Ensure that there are `max` words or fewer for the given value:

```php
Rule::maxWords(10)
// or
new MaxWords(10)
```

### MinWords

Ensure that there are `min` words or more for the given value:

```php
Rule::minWords(5)
// or
new MinWords(5)
```

### WordsBetween

Ensure that there are between `min` and `max` words in the given value:

```php
Rule::wordsBetween(5, 10)
// or
new WordsBetween(5, 10)
```
