<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukDate;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Closure;
use DateException;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\ValidatorAwareRule;
use Illuminate\Validation\Concerns\ValidatesAttributes;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

abstract class DateRule implements DataAwareRule, ValidationRule, ValidatorAwareRule
{
    use ValidatesAttributes;

    public array $data = [];

    public string $messageFormat = 'd/m/Y';

    public Validator $validator;

    abstract protected function test(Carbon $enteredDate, Carbon $comparisonDate): ?string;

    // Setup
    public function __construct(
        public Carbon|string $comparisonField,
        public ?string $enteredTimeField = null,
        public ?string $comparisonTimeField = null,
    ) {
        //
    }

    // ValidationRule
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Entered date parts
        $enteredDay = $this->getDatePart($attribute, 'day');
        $enteredMonth = $this->getDatePart($attribute, 'month');
        $enteredYear = $this->getDatePart($attribute, 'year');
        $enteredTime = $this->getTimePart(
            $this->getTimeField($attribute, $this->enteredTimeField),
        );

        // Nullable
        if ($this->isNull($attribute, $enteredDay, $enteredMonth, $enteredYear) === true) {
            return;
        }

        // Entered date
        $enteredDate = $this->parseDate($enteredDay, $enteredMonth, $enteredYear, $enteredTime);
        if (is_string($enteredDate) === true) {
            $fail($enteredDate);
            return;
        }

        // Comparison date
        if ($this->comparisonField instanceof Carbon === true) {
            $comparisonDate = $this->comparisonField;
        } else {
            $comparisonDay = $this->getDatePart($this->comparisonField, 'day');
            $comparisonMonth = $this->getDatePart($this->comparisonField, 'month');
            $comparisonYear = $this->getDatePart($this->comparisonField, 'year');
            $comparisonTime = $this->getTimePart(
                $this->getTimeField($attribute, $this->comparisonTimeField),
            );

            $comparisonDate = $this->parseDate($comparisonDay, $comparisonMonth, $comparisonYear, $comparisonTime);
            if (is_string($comparisonDate) === true) {
                $fail($comparisonDate);
                return;
            }
        }

        $this->setupMessageFormat($enteredDay, $enteredMonth, $enteredYear, $enteredTime);

        // Validate
        $error = $this->test($enteredDate, $comparisonDate);
        if ($error !== null) {
            $fail($error);
        }
    }

    public function getTimeField(string $attribute, ?string $initial): ?string
    {
        if ($initial !== null) {
            return $initial;
        }

        $key = "$attribute-time";
        return array_key_exists($key, $this->data) === true
            ? $key
            : null;
    }

    public function getDatePart(string $attribute, string $part): ?int
    {
        $key = "$attribute-$part";

        if (array_key_exists($key, $this->data) === false) {
            return null;
        }

        $value = intval($this->data[$key]);

        return $value !== 0
            ? $value
            : null;
    }

    public function getTimePart(?string $attribute): ?string
    {
        if (
            $attribute !== null
            && array_key_exists($attribute, $this->data) === true
        ) {
            return $this->data[$attribute];
        }

        return null;
    }

    public function isNull(
        string $enteredField,
        ?int $enteredDay,
        ?int $enteredMonth,
        ?int $enteredYear
    ): bool {
        $isNullable = in_array(
            Rule::nullable(),
            $this->validator->getRules()[$enteredField],
        );

        return $isNullable === true
            && $enteredDay === null
            && $enteredMonth === null
            && $enteredYear === null;
    }

    public function parseDate(?int $day, ?int $month, ?int $year, ?string $time): Carbon|string
    {
        $error = $this->hasValidDateParts($day, $month, $year, $time);
        if ($error !== null) {
            return $error;
        }

        $now = Carbon::now()->setTimezone('Europe/London');
        $data = [
            '-day' => $day ?? $now->day,
            '-month' => $month ?? $now->month,
            '-year' => $year ?? $now->year,
            '-time' => $time ?? $now->format('H:i'),
        ];

        return GovukDate::parseDateTime($data, '', '-time');
    }

    public function hasValidDateParts(?int $day, ?int $month, ?int $year, ?string $time): ?string
    {
        if (
            $day === null
            && $month === null
            && $year === null
        ) {
            return 'Provide a date for :attribute';
        }

        $error = $this->isValidDay($day);
        if ($error !== null) {
            return $error;
        }

        $error = $this->isValidMonth($month);
        if ($error !== null) {
            return $error;
        }

        $error = $this->isValidYear($year);
        if ($error !== null) {
            return $error;
        }

        $error = $this->isValidTime($time);
        if ($error !== null) {
            return $error;
        }

        return null;
    }

    public function isValidDay(?int $day): ?string
    {
        if ($day !== null) {
            if ($this->validateDigitsBetween('day', $day, [1, 2]) === false) {
                return ':Attribute day must be one or two digits long';
            }

            if ($day < 1 || $day > 31) {
                return ':Attribute day must be between 1 and 31';
            }
        }

        return null;
    }

    public function isValidMonth(?int $month): ?string
    {
        if ($month !== null) {
            if ($this->validateDigitsBetween('month', $month, [1, 2]) === false) {
                return ':Attribute month must be one or two digits long';
            }

            if ($month < 1 || $month > 12) {
                return ':Attribute month must be between 1 and 12';
            }
        }

        return null;
    }

    public function isValidYear(?int $year): ?string
    {
        if ($year !== null) {
            if (
                $this->validateDigits('year', $year, [2]) === false
                && $this->validateDigits('year', $year, [4]) === false
            ) {
                return ':Attribute year must be two or four digits long';
            }
        }

        return null;
    }

    public function isValidTime(?string $time): ?string
    {
        if ($time !== null) {
            try {
                GovukDate::standardiseTime([
                    'time' => $time,
                ], 'time');
            } catch (DateException $exception) {
                return ':Attribute is not a valid time';
            }
        }

        return null;
    }

    public function setupMessageFormat(?int $day, ?int $month, ?int $year, ?string $time): void
    {
        $format = '';

        if ($day !== null) {
            $format = 'd';
        }

        if ($month !== null) {
            $format .= $day !== null
                ? '/m'
                : 'm';
        }

        if ($year !== null) {
            $format .= $day !== null
                || $month !== null
                ? '/Y'
                : 'Y';
        }

        if ($time !== null) {
            $format .= ' H:i';
        }

        $this->messageFormat = $format;
    }

    // DataAwareRule
    public function setData($data): self
    {
        $this->data = $data;
        return $this;
    }

    // ValidatorAwareRule
    public function setValidator(Validator $validator): self
    {
        $this->validator = $validator;
        return $this;
    }
}
