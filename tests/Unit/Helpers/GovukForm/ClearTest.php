<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukForm;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Session;

class ClearTest extends TestCase
{
    public function testClearsSession(): void
    {
        GovukForm::put('potato', new FormModel());
        GovukForm::clear('potato');

        $this->assertFalse(
            Session::has('potato')
        );
    }
}
