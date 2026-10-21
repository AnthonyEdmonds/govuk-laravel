<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates\DateRule;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\AfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\DateRule;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class ValidateTest extends TestCase
{
    protected DateRule $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new AfterDate(Carbon::today());

        $this->rule->setData([
            'test' => 1,
            'test-day' => 10,
            'test-month' => 12,
            'test-year' => 2026,
            'test-time' => '12:56',
        ]);

        $this->rule->setValidator(
            new Validator(
                app(Translator::class),
                [],
                [
                    'test' => [
                        Rule::nullable(),
                    ],
                ],
            ),
        );
    }

    public function testWhenNull(): void
    {
        $this->rule->setData([]);

        $this->runPassingTest();
    }

    public function testInvalidEnteredDate(): void
    {
        $this->rule->setData([
            'test-day' => 69,
        ]);

        $this->runFailingTest(':Attribute day must be between 1 and 31');
    }

    public function testCarbonComparison(): void
    {
        $this->rule->validate();
    }

    public function testStringComparison(): void
    {
        $this->rule->validate();
    }

    public function testInvalidComparison(): void
    {
        $this->rule->validate();
    }

    public function testRuleFails(): void
    {
        $this->rule->validate();
    }

    public function testRulePasses(): void
    {
        $this->rule->validate();
    }

    protected function runPassingTest(): void
    {
        $this->rule->validate('test', 1, function (string $message) {
            $this->fail("Rule should not have failed: $message");
        });

        $this->assertTrue(true);
    }

    protected function runFailingTest(string $expected): void
    {
        $passed = true;

        $this->rule->validate('test', 1, function (string $message) use (&$passed, $expected) {
            $passed = false;

            $this->assertEquals(
                $expected,
                $message,
                "Rule failed with wrong message: $message",
            );
        });

        if ($passed === true) {
            $this->fail("Rule should have failed: $expected");
        }
    }
}
