<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukComponent;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukComponent;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class ToAttributesTest extends TestCase
{
    public function testFormatsArrayAsAttributes(): void
    {
        $attributes = [
            'length' => 'long',
            'size' => 12,
            'width' => 'very',
        ];

        $this->assertEquals(
            'length="long" size="12" width="very"',
            GovukComponent::toAttributes($attributes),
        );
    }
}
