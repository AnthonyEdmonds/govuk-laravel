<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Questions\Question;
use Illuminate\Contracts\View\View;

class GovukPage
{
    public static function confirm(
        string $title,
        string $blade,
        string $buttonLabel,
        string $action,
        string $back,
        string $method = 'post',
        string $buttonType = Page::NORMAL_BUTTON,
        string $caption = null
    ): View
    {
        return Page::create($title)
            ->setAction($action)
            ->setBack($back)
            ->setButtonLabel($buttonLabel)
            ->setButtonType($buttonType)
            ->setCaption($caption)
            ->setContent($blade)
            ->setMethod($method)
            ->setTemplate('confirm')
            ->toView();
    }

    public static function custom(
        string $title,
        string $contentBlade,
        array $breadcrumbs,
        string $caption = null
    ): View
    {
        return Page::create($title)
            ->setBreadcrumbs($breadcrumbs)
            ->setCaption($caption)
            ->setContent($contentBlade)
            ->setTemplate('custom')
            ->toView();
    }
    
    public static function error(string $title, string $contentBlade): View
    {
        return Page::create($title)
            ->setBack(back()->getTargetUrl())
            ->setContent($contentBlade)
            ->setTemplate('error')
            ->toView();
    }
    
    public static function question(
        Question $question,
        string $blade,
        string $buttonLabel,
        string $action,
        string $back,
        string $method = 'post',
        string $buttonType = Page::NORMAL_BUTTON
    ): View
    {
        return Page::create($question->label)
            ->hideTitle()
            ->setAction($action)
            ->setBack($back)
            ->setButtonLabel($buttonLabel)
            ->setButtonType($buttonType)
            ->setContent($blade)
            ->setMethod($method)
            ->setQuestion($question)
            ->setTemplate('question')
            ->toView();
    }

    public static function start(): View
    {
        // TODO
    }

    public static function summary(): View
    {
        // TODO
    }

    public static function tasklist(): View
    {
        // TODO
    }
}
