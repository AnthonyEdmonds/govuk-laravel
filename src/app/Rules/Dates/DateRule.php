<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

abstract class DateRule implements ValidationRule, DataAwareRule
{
    protected array $data;

    protected string $message;

    protected string $messageFormat = 'd/m/Y';

    abstract protected function test(Carbon $enteredDate): bool;

    public function __construct(
        protected Carbon $date,
        protected string|null $timeField = null,
    ) {
        //
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $day = $this->data["$attribute-day"];
        $month = $this->data["$attribute-month"];
        $year = $this->data["$attribute-year"];

        $enteredDate = Carbon::createFromFormat('Y-m-d', "$year-$month-$day");

        if ($this->timeField !== null) {
            try {
                $enteredDate->setTimeFrom(
                    Carbon::parse($this->data[$this->timeField])
                );

                $this->messageFormat .= ' H:i';
            } catch (InvalidFormatException $exception) {
                $fail("$this->timeField must be a real time");

                return;
            }
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
