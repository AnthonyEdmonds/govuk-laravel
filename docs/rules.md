# Rules

Each rule can be used as a macro, or as an instance.

## Dates

The `date-input` component is slightly unusual from a Laravel validation point of view, as it is submitted in three parts.

These rules check to make sure that the specified date exists, and must be applied to a rule against the main `name` of the input.

```php
[
    'birth' => [
        'required',
        new BeforeDate(Carbon::now()),
    ],
    'birth-day' => [
        // Not here
    ],
]
```

You may provide the name of a field as the second parameter to add a time input, which will validate both date and time.

```php
[
    'birth-time' => [
        'required',
        new TimeFormat(),
    ],
    'birth-date' => [
        'required',
        new BeforeDate(Carbon::now(), 'birth-time'),
    ],
]
```

Dates can be provided with or without leading digits.

```php
'24-7-1' or '2024-07-01'
```

### AfterDate

Ensure that the submitted date is after a particular day.

```php
Rule::afterDate(Carbon::now())
// or
new AfterDate(Carbon::now())
```

### BeforeDate

Ensure that the submitted date is before a particular day.

```php
Rule::beforeDate(Carbon::now())
// or
new BeforeDate(Carbon::now())
```

### DateFormat

Ensure that the given date is in GOV.UK format, complete with a `-day`, `-month`, and `-year`.

```php
Rule::dateFormat()
// or
new DateFormat()
```

### OnDate

Ensure that the submitted date is on a particular day.

```php
Rule::onDate(Carbon::now())
// or
new OnDate(Carbon::now())
```

### OnOrAfterDate

Ensure that the submitted date is on or after a particular day.

```php
Rule::onOrAfterDate(Carbon::now())
// or
new OnOrAfterDate(Carbon::now())
```

### OnOrBeforeDate

Ensure that the submitted date is on or before a particular day.

```php
Rule::onOrBeforeDate(Carbon::now())
// or
new OnOrBeforeDate(Carbon::now())
```

## Times

Validate that a given time is valid.

These Rules only check the time; date validation must be run separately.

### AfterTime

Ensure that the submitted time is after a particular hour and minute.

```php
Rule::afterTime(Carbon::now())
// or
new AfterTime(Carbon::now())
```

### AtOrAfterTime

Ensure that the submitted time is on or after a particular hour and minute.

```php
Rule::atOrAfterTime(Carbon::now())
// or
new AtOrAfterTime(Carbon::now())
```

### AtOrBeforeTime

Ensure that the submitted time is on or before a particular hour and minute.

```php
Rule::atOrBeforeTime(Carbon::now())
// or
new AtOrBeforeTime(Carbon::now())
```

### AtTime

Ensure that the submitted time is on a particular hour and minute.

```php
Rule::atTime(Carbon::now())
// or
new AtTime(Carbon::now())
```

### BeforeTime

Ensure that the submitted time is before a particular hour and minute.

```php
Rule::beforeTime(Carbon::now())
// or
new BeforeTime(Carbon::now())
```

### TimeFormat

Ensure that the given time is in a format that PHP can interpret.

Time can be input in many different ways, including 12 and 24 hour formats.

Accepting as many different time formats will ensure the user can specify the time in a way that makes sense to them.

A full list of the formats this rule will accept is available in the class definition.

```php
Rule::timeFormat()
//or
new TimeFormat()
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
