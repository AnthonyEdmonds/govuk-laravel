<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Concerns\ValidatesAttributes;

abstract class DateRule implements DataAwareRule, ValidationRule
{
    use ValidatesAttributes;

    protected array $data;

    protected string $message;

    protected string $messageFormat = 'd/m/Y';

    abstract protected function test(Carbon $enteredDate): bool;

    public function __construct(
        protected Carbon $date,
        protected ?string $timeField = null,
    ) {
        if ($this->timeField === null) {
            $this->date->setTime(0, 0);
        }
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $day = $this->data["$attribute-day"];
        $month = $this->data["$attribute-month"];
        $year = $this->data["$attribute-year"];

        if ($this->validateDigitsBetween($attribute, $day, [1, 2]) === false) {
            $fail(':attribute day must be a number');

            return;
        }

        if ($this->validateDigitsBetween($attribute, $month, [1, 2]) === false) {
            $fail(':attribute month must be a number');

            return;
        }

        if ($this->validateDigitsBetween($attribute, $year, [1, 4]) === false) {
            $fail(':attribute year must be a number');

            return;
        }

        $dayFormat = strlen($day) < 2 ? 'j' : 'd';
        $monthFormat = strlen($month) < 2 ? 'n' : 'm';
        $yearFormat = strlen($year) < 4 ? 'y' : 'Y';
        $enteredDate = Carbon::createFromFormat("$yearFormat-$monthFormat-$dayFormat", "$year-$month-$day");

        if ($this->timeField !== null) {
            try {
                $enteredDate->setTimeFrom(
                    Carbon::parse($this->data[$this->timeField]),
                );

                $this->messageFormat .= ' H:i';
            } catch (InvalidFormatException $exception) {
                $fail("$this->timeField must be a real time");

                return;
            }
        } else {
            $enteredDate->setTime(0, 0);
        }

        if ($enteredDate->isValid() === false) {
            $fail(':attribute must be a real date');

            return;
        }

        if ($this->test($enteredDate) === false) {
            $fail($this->message);
        }
    }

    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }
}
