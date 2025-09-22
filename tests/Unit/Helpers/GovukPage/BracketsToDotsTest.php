<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukPage;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class BracketsToDotsTest extends TestCase
{
    public function testSkipsWhenNoBrackets(): void
    {
        $this->assertEquals(
            'my_name',
            GovukPage::bracketsToDots('my_name'),
        );
    }

    public function testReplacesBrackets(): void
    {
        $this->assertEquals(
            'my_name.is.bob',
            GovukPage::bracketsToDots('my_name[is][bob]'),
        );
    }
}
