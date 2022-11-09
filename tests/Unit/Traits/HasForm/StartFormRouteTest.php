<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Traits\HasForm;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Routing\Route;

class StartFormRouteTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();
    }

    public function testGetsFormStartUrl(): void
    {
        $this->assertEquals(
            route('forms.start', TestForm::key()),
            FormModel::startFormRoute()
        );
    }
}
