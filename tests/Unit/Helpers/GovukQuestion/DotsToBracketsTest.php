<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukQuestion;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion;
use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class DotsToBracketsTest extends TestCase
{
    protected Question $question;

    public function testSkipsWhenNoDots(): void
    {
        $this->assertEquals(
            'my_name',
            GovukQuestion::dotsToBrackets('my_name'),
        );
    }

    public function testReplacesDots(): void
    {
        $this->assertEquals(
            'my_name[is][bob]',
            GovukQuestion::dotsToBrackets('my_name.is.bob'),
        );
    }
}
