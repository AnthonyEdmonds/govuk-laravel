<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Traits\HasForm;

use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class CanSubmitTest extends TestCase
{
    protected FormModel $model;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new FormModel();
    }

    public function testTrueWhenOK(): void
    {
        $this->model->name = 'Bob';

        $this->assertTrue(
            $this->model->canSubmit(),
        );
    }

    public function testMessageWhenNot(): void
    {
        $this->assertEquals(
            'You must put a name',
            $this->model->canSubmit(),
        );
    }
}
