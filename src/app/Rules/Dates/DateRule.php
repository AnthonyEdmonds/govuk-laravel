<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

abstract class DateRule implements Rule, DataAwareRule
{
    public const ATTRIBUTE = 'my-date';
    public const VALUE = 'not-used';

    protected array $data;
    protected string $message;

    abstract protected function test(Carbon $enteredDate): bool;

    public function __construct(
        protected Carbon $date,
    ) {
        //
    }

    public function passes($attribute, $value): bool
    {
        $day = $this->data["$attribute-day"];
        $month = $this->data["$attribute-month"];
        $year = $this->data["$attribute-year"];

        $enteredDate = Carbon::createFromFormat('Y-m-d', "$year-$month-$day");

        if ($enteredDate->isValid() === false) {
            $this->message = ':attribute is not a date that exists';
            return false;
        }

        return $this->test($enteredDate);
    }

    public function message(): string
    {
        return $this->message;
    }

    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }
}
