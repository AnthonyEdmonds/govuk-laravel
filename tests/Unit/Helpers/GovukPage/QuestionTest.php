<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukPage;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class QuestionTest extends TestCase
{
    protected array $page;

    protected Question $question;

    public function testHasQuestion(): void
    {
        $this->makePage();

        $this->assertInstanceOf(
            Question::class,
            $this->page['questions'][0],
        );
    }

    public function testHasSubmitButtonLabel(): void
    {
        $this->makePage();

        $this->assertEquals(
            'for',
            $this->page['submitButtonLabel'],
        );
    }

    public function testHasAction(): void
    {
        $this->makePage();

        $this->assertEquals(
            'toll',
            $this->page['action'],
        );
    }

    public function testHasBack(): void
    {
        $this->makePage();

        $this->assertEquals(
            'cheese',
            $this->page['back'],
        );
    }

    public function testHasMethod(): void
    {
        $this->makePage();

        $this->assertEquals(
            'caramel',
            $this->page['method'],
        );
    }

    public function testHasBlade(): void
    {
        $this->makePage();

        $this->assertEquals(
            'dog',
            $this->page['content'],
        );
    }

    public function testHasOtherButtonLabel(): void
    {
        $this->makePage();

        $this->assertEquals(
            'bird',
            $this->page['otherButtonLabel'],
        );
    }

    public function testHasOtherButtonHref(): void
    {
        $this->makePage();

        $this->assertEquals(
            'Lizard',
            $this->page['otherButtonHref'],
        );
    }

    public function testSubmitButtonType(): void
    {
        $this->makePage();

        $this->assertEquals(
            Page::START_BUTTON,
            $this->page['submitButtonType'],
        );
    }

    public function testIsTitleIsTrue(): void
    {
        $this->makePage();

        $this->assertTrue(
            $this->question->isTitle,
        );
    }

    public function testLabelSizeIsLarge(): void
    {
        $this->makePage();

        $this->assertEquals(
            'l',
            $this->question->labelSize,
        );
    }

    public function testPageTitleIsSetByQuestion(): void
    {
        $this->makePage();

        $this->assertEquals(
            'too',
            $this->page['title'],
        );
    }

    public function testOtherButtonLabelIsDefaultWhenNull(): void
    {
        $this->makePage(null);

        $this->assertEquals(
            Page::OTHER_BUTTON_LABEL,
            $this->page['otherButtonLabel'],
        );
    }

    public function testSetTemplate(): void
    {
        $this->makePage();

        $this->assertEquals(
            'question',
            $this->page['template'],
        );
    }

    protected function makePage(
        string|null $otherButtonLabel = 'bird',
    ): void {
        $this->question = new Question('too', 'strange', Question::CHECKBOXES);
        $this->page = GovukPage::question(
            $this->question,
            'for',
            'toll',
            'cheese',
            'caramel',
            'dog',
            $otherButtonLabel,
            'Lizard',
            Page::START_BUTTON
        )->toArray();
    }
}
