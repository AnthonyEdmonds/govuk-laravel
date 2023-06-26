<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukQuestion;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion;
use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class RadiosTest extends TestCase
{
    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = GovukQuestion::radios(
            'My question',
            'my_name',
            [
                'value_1' => 'One',
                'value_2' => 'Two',
                'value_3' => 'Three',
            ],
            'my_id'
        );
    }

    public function testHasLabel(): void
    {
        $this->assertEquals(
            'My question',
            $this->question->label
        );
    }

    public function testHasName(): void
    {
        $this->assertEquals(
            'my_name',
            $this->question->name
        );
    }

    public function testHasOptions(): void
    {
        $this->assertEquals(
            [
                'value_1' => 'One',
                'value_2' => 'Two',
                'value_3' => 'Three',
            ],
            $this->question->options
        );
    }

    public function testHasId(): void
    {
        $this->assertEquals(
            'my_id',
            $this->question->id
        );
    }
}
