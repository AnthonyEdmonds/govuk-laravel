<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
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
        $this->page = $this->form->start();
    }

    public function testHasTitle(): void
    {
        $this->assertEquals(
            'Begin your application',
            $this->page->getData()['title']
        );
    }

    public function testHasBlade(): void
    {
        $this->assertEquals(
            'test.start',
            $this->page->getData()['content']
        );
    }

    public function testHasStartRoute(): void
    {
        $this->assertEquals(
            route('forms.start', TestForm::key()),
            $this->page->getData()['action']
        );
    }

    public function testHasButtonLabel(): void
    {
        $this->assertEquals(
            'Start',
            $this->page->getData()['submitButtonLabel']
        );
    }

    public function testHasExitRoute(): void
    {
        $this->assertEquals(
            route('/'),
            $this->page->getData()['back']
        );
    }
}
