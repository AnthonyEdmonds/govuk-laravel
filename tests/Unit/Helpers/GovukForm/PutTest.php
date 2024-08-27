<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukForm;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class PutTest extends TestCase
{
    public function testSetsSession(): void
    {
        GovukForm::put('potato', new FormModel);

        $this->assertInstanceOf(FormModel::class, GovukForm::get('potato'));
    }
}
