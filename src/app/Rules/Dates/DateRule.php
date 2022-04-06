<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

abstract class DateRule implements Rule, DataAwareRule
{
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
        $enteredDate = $this->getEnteredDate($attribute);

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

    protected function getEnteredDate(string $attribute): Carbon
    {
        $prefix = substr(
            $attribute,
            0,
            strrpos($attribute, '-')
        );

        $day = $this->data["$prefix-day"];
        $month = $this->data["$prefix-month"];
        $year = $this->data["$prefix-year"];

        return Carbon::createFromFormat('Y-m-d', "$year-$month-$day");
    }
}
