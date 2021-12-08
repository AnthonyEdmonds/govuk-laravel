# Rules

If you are using an input with a words counter, you may wish to ensure that the limit is enforced server-side with some rules.

Each rule can be used ~~inline,~~ as a macro, or as an instance.

## MaxWords

Ensure that there are `max` words or fewer for the given value:

```php
'max_words:10'
// or
Rule::maxWords(10)
// or
new MaxWords(10)
```

## MinWords

Ensure that there are `min` words or more for the given value:

```php
'min_words:5'
// or
Rule::minWords(5)
// or
new MinWords(5)
```

## WordsBetween

Ensure that there are between `min` and `max` words in the given value:

```php
'words_between:5,10'
// or
Rule::wordsBetween(5, 10)
// or
new WordsBetween(5, 10)
```
