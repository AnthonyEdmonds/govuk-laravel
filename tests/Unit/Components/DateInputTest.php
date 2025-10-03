<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use InvalidArgumentException;
use NunoMaduro\LaravelMojito\ViewAssertion;

class DateInputTest extends TestCase
{
    public function testSuffixesBday(): void
    {
        $this->makeDateInput([
            'autocomplete' => 'bday',
        ])
            ->first('input[type=text]')
            ->hasAttribute('autocomplete', 'bday-day');
    }

    public function testSuffixedCcExp(): void
    {
        $this->makeDateInput([
            'autocomplete' => 'cc-exp',
        ])
            ->first('input[type=text]')
            ->hasAttribute('autocomplete', 'cc-exp-month');
    }

    public function testHasAutocomplete(): void
    {
        $this->makeDateInput()
            ->first('input[type=text]')
            ->hasAttribute('autocomplete', 'on');
    }

    public function testHasHint(): void
    {
        $this->makeDateInput()
            ->first('div .govuk-hint')
            ->contains('Enter the day, month, and year');
    }

    public function testHasId(): void
    {
        $this->makeDateInput()
            ->first('input[type=text]')
            ->hasAttribute('id', 'my-id-day');
    }

    public function testStylesLabelAsTitle(): void
    {
        $this->makeDateInput([
            'isTitle' => true,
        ])
            ->first('legend')
            ->has('h1');
    }

    public function testHasLabel(): void
    {
        $this->makeDateInput()
            ->first('legend')
            ->contains('When is your birthday?');
    }

    public function testHasName(): void
    {
        $this->makeDateInput()
            ->first('input[type=text]')
            ->hasAttribute('name', 'my-name-day');
    }

    public function testHidesDay(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->makeDateInput([
            'noDay' => true,
        ])
            ->first('#my-id-day');
    }

    public function testHidesMonth(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->makeDateInput([
            'noMonth' => true,
        ])
            ->first('#my-id-month');
    }

    public function testHidesYear(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->makeDateInput([
            'noYear' => true,
        ])
            ->first('#my-id-year');
    }

    public function testHasDayValue(): void
    {
        $this->makeDateInput([
            'value' => [
                'day' => 31,
            ],
        ])
            ->first('#my-id-day')
            ->hasAttribute('value', '31');
    }

    public function testHasMonthValue(): void
    {
        $this->makeDateInput([
            'value' => [
                'month' => 12,
            ],
        ])
            ->first('#my-id-month')
            ->hasAttribute('value', '12');
    }

    public function testHasYearValue(): void
    {
        $this->makeDateInput([
            'value' => [
                'year' => 2000,
            ],
        ])
            ->first('#my-id-year')
            ->hasAttribute('value', '2000');
    }

    protected function makeDateInput(array $addon = []): ViewAssertion
    {
        $this->setViewAttributes();
        $this->setViewErrors();

        return $this->assertView('govuk::components.date-input', [
            'hint' => 'Enter the day, month, and year',
            'id' => 'my-id',
            'label' => 'When is your birthday?',
            'name' => 'my-name',
        ], $addon);
    }
}
