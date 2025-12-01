<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukComponent;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukComponent;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class MakeTableColumnJsonTest extends TestCase
{
    public function testCreatesJson(): void
    {
        $this->assertEquals(
            json_encode([
                'heading' => true,
                'hide' => null,
                'html' => 'My HTML',
                'label' => 'My label',
                'numeric' => false,
                'show' => null,
            ]),
            GovukComponent::makeTableColumnJson(
                true,
                '',
                'My label',
                false,
                '',
                'My HTML',
            ),
        );
    }

    public function testToggles(): void
    {
        $this->assertEquals(
            json_encode([
                'heading' => false,
                'hide' => 'hide',
                'html' => 'My HTML',
                'label' => 'My label',
                'numeric' => true,
                'show' => 'show',
            ]),
            GovukComponent::makeTableColumnJson(
                false,
                'hide',
                'My label',
                true,
                'show',
                'My HTML',
            ),
        );
    }
}
