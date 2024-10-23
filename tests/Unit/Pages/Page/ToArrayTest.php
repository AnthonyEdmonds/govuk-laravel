<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Pages\Page;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class ToArrayTest extends TestCase
{
    public function test(): void
    {
        $page = Page::create('My title');
        $question = GovukQuestion::hidden('my-name', 'my-value');

        $page->setAction('my-action');
        $page->setBack('back-route');
        $page->setBreadcrumbs([
            'Label' => 'route',
        ]);
        $page->setCaption('my-caption');
        $page->setContent('my-content');
        $page->hideTitle();
        $page->setMethod(Page::POST_METHOD);
        $page->setOtherButtonHref('other-href');
        $page->setOtherButtonLabel('other-label');
        $page->setOtherButtonMethod(Page::POST_METHOD);
        $page->setCurrentSection('current');
        $page->setQuestion($question);
        $page->setSubmitButtonLabel('submit-label');
        $page->setSubmitButtonType(Page::SECONDARY_BUTTON);
        $page->setSummary([
            'My summary',
        ]);
        $page->setTemplate('my-template');

        $this->assertEquals(
            [
                'action' => 'my-action',
                'back' => null,
                'breadcrumbs' => [
                    'Label' => 'route',
                ],
                'caption' => 'my-caption',
                'content' => 'my-content',
                'currentSection' => 'current',
                'hideTitle' => true,
                'method' => Page::POST_METHOD,
                'otherButtonHref' => 'other-href',
                'otherButtonLabel' => 'other-label',
                'otherButtonMethod' => Page::POST_METHOD,
                'questions' => [
                    $question,
                ],
                'submitButtonLabel' => 'submit-label',
                'submitButtonType' => Page::SECONDARY_BUTTON,
                'summary' => [
                    'My summary',
                ],
                'template' => 'my-template',
                'title' => 'My title',
            ],
            $page->toArray(),
        );
    }
}
