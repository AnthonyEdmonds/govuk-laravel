<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukForm;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class StartTest extends TestCase
{
    protected TestForm $form;

    protected Page $page;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();

        $this->form = new TestForm();
    }

    public function testHasBlade(): void
    {
        $data = $this->form
            ->start()
            ->getData();

        $this->assertEquals(
            'test.start',
            $data['content'],
        );

        $this->assertEquals(
            'Begin your application',
            $data['title']
        );

        $this->assertEquals(
            route('forms.start', TestForm::key()),
            $data['action']
        );

        $this->assertEquals(
            'Start',
            $data['submitButtonLabel']
        );

        $this->assertEquals(
            route('/'),
            $data['back']
        );

        $this->assertFalse(
            $data['isInProgress']
        );

        $this->assertEquals(
            route('forms.summary', [TestForm::key(), Form::NEW]),
            $data['summaryRoute']
        );
    }

    public function testHasResumeWhenNew(): void
    {
        GovukForm::put(TestForm::key(), FormModel::factory()->make());

        $data = $this->form
            ->start()
            ->getData();

        $this->assertTrue(
            $data['isInProgress']
        );

        $this->assertEquals(
            route('forms.summary', [TestForm::key(), Form::REVIEW]),
            $data['summaryRoute']
        );
    }

    public function testHasResumeWhenExisting(): void
    {
        $model = FormModel::factory()->make();
        $model->exists = true;

        GovukForm::put(TestForm::key(), $model);

        $data = $this->form
            ->start()
            ->getData();

        $this->assertTrue(
            $data['isInProgress']
        );

        $this->assertEquals(
            route('forms.summary', [TestForm::key(), Form::EDIT]),
            $data['summaryRoute']
        );
    }
}
