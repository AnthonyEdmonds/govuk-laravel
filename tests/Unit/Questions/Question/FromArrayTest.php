<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Questions\Question;

use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class FromArrayTest extends TestCase
{
    public const SETTINGS = [
        'count' => 1,
        'hint' => 'test',
        'inputmode' => 'friday',
    ];

    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new Question('Duck', 'Dave', Question::CHECKBOXES);
        $this->question->fromArray(self::SETTINGS);
    }

    public function testFromArray(): void
    {
        foreach (self::SETTINGS as $property => $value) {
            $this->assertEquals($value, $this->question->$property);
        }
    }
}
