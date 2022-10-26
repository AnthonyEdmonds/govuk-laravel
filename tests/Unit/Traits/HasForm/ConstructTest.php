<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Traits\HasForm;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class ConstructTest extends TestCase
{
    protected FormModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new FormModel();
    }

    public function testCreatesForm(): void
    {
        $this->assertInstanceOf(
            TestForm::class,
            $this->model->form
        );
    }
}
