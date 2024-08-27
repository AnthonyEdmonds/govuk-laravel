<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukForm;

use AnthonyEdmonds\GovukLaravel\Exceptions\FormExpiredException;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class GetTest extends TestCase
{
    public function testReturnsModel(): void
    {
        GovukForm::put('potato', new FormModel());

        $this->assertInstanceOf(
            FormModel::class,
            GovukForm::get('potato'),
        );
    }

    public function testThrowsExceptionWhenMissing(): void
    {
        $this->expectException(FormExpiredException::class);
        $this->expectExceptionMessage('The form you are trying to access has expired. Please start again.');

        GovukForm::get('potato');
    }
}
