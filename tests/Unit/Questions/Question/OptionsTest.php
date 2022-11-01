<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Questions\Question;

use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Collection;

class OptionsTest extends TestCase
{
    public const OPTIONS = [
        1,
        2,
        3,
        4,
    ];

    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();
        $this->question = new Question('Duck', 'Dave', Question::CHECKBOXES);
    }

    public function testSetsFromArray(): void
    {
        $this->question->options(self::OPTIONS);
        $this->assertEquals(self::OPTIONS, $this->question->options);
    }

    public function testSetsFromCollection(): void
    {
        $this->question->options(new Collection(self::OPTIONS));
        $this->assertEquals(self::OPTIONS, $this->question->options);
    }
}
