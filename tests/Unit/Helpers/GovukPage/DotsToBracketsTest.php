<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukPage;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class DotsToBracketsTest extends TestCase
{
    public function testSkipsWhenNoDots(): void
    {
        $this->assertEquals(
            'my_name',
            GovukPage::dotsToBrackets('my_name'),
        );
    }

    public function testReplacesDots(): void
    {
        $this->assertEquals(
            'my_name[is][bob]',
            GovukPage::dotsToBrackets('my_name.is.bob'),
        );
    }
}
