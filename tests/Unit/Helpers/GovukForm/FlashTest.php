<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukForm;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class FlashTest extends TestCase
{
    public function testFlashesSession(): void
    {
        GovukForm::flash('potato', new FormModel());

        $this->assertInstanceOf(FormModel::class, GovukForm::get('potato'));
    }
}
