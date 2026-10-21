<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates\DateRule;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\AfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\DateRule;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class SetValidatorTest extends TestCase
{
    protected DateRule $rule;

    protected Validator $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new Validator(
            app(Translator::class),
            [],
            [
                'test' => [Rule::nullable()],
            ],
        );

        $this->rule = new AfterDate(Carbon::today());

        $this->rule->setValidator($this->validator);
    }

    public function test(): void {
        $this->assertEquals(
            $this->validator,
            $this->rule->validator,
        );
    }
}
