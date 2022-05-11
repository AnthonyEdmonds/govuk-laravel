<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Questions\Question;

class GovukPage
{
    public static function confirm(
        string $title,
        string $blade,
        string $submitButtonLabel,
        string $action,
        string $back,
        string $method = 'post',
        string $otherButtonLabel = null,
        string $otherButtonHref = null,
        string $submitButtonType = Page::NORMAL_BUTTON,
        string $caption = null
    ): Page {
        return Page::create($title)
            ->setAction($action)
            ->setBack($back)
            ->setSubmitButtonLabel($submitButtonLabel)
            ->setSubmitButtonType($submitButtonType)
            ->setOtherButtonHref($otherButtonHref ?? $back)
            ->setOtherButtonLabel($otherButtonLabel ?? Page::OTHER_BUTTON_LABEL)
            ->setCaption($caption)
            ->setContent($blade)
            ->setMethod($method)
            ->setTemplate('confirm');
    }

    public static function confirmation(string $title): Page
    {
        // TODO

        return Page::create($title);
    }

    public static function custom(
        string $title,
        string $blade,
        array $breadcrumbs,
        string $caption = null
    ): Page {
        return Page::create($title)
            ->setBreadcrumbs($breadcrumbs)
            ->setCaption($caption)
            ->setContent($blade)
            ->setTemplate('custom');
    }

    public static function error(string $title, string $contentBlade): Page
    {
        return Page::create($title)
            ->setBack(back()->getTargetUrl())
            ->setContent($contentBlade)
            ->setTemplate('error');
    }

    public static function feedback(string $title): Page
    {
        // TODO

        return Page::create($title);
    }

    public static function question(
        Question $question,
        string $submitButtonLabel,
        string $action,
        string $back,
        string $method = 'post',
        string $blade = null,
        string $otherButtonLabel = null,
        string $otherButtonHref = null,
        string $submitButtonType = Page::NORMAL_BUTTON
    ): Page {
        $question
            ->isTitle()
            ->labelSize('l');

        return Page::create($question->label)
            ->hideTitle()
            ->setAction($action)
            ->setBack($back)
            ->setSubmitButtonLabel($submitButtonLabel)
            ->setSubmitButtonType($submitButtonType)
            ->setOtherButtonHref($otherButtonHref)
            ->setOtherButtonLabel($otherButtonLabel ?? Page::OTHER_BUTTON_LABEL)
            ->setContent($blade)
            ->setMethod($method)
            ->setQuestion($question)
            ->setTemplate('question');
    }

    public static function questions(
        string $title,
        array $questions,
        string $submitButtonLabel,
        string $action,
        string $back = null,
        string $method = 'post',
        string $blade = null,
        string $otherButtonLabel = null,
        string $otherButtonHref = null,
        string $submitButtonType = Page::NORMAL_BUTTON
    ): Page {
        return Page::create($title)
            ->setAction($action)
            ->setBack($back)
            ->setSubmitButtonLabel($submitButtonLabel)
            ->setSubmitButtonType($submitButtonType)
            ->setOtherButtonHref($otherButtonHref)
            ->setOtherButtonLabel($otherButtonLabel ?? Page::OTHER_BUTTON_LABEL)
            ->setContent($blade)
            ->setMethod($method)
            ->setQuestions($questions)
            ->setTemplate('question');
    }

    public static function start(string $title): Page
    {
        // TODO
        return Page::create($title);
    }

    public static function summary(
        string $title,
        array $summary,
        string $submitButtonLabel,
        string $action,
        string $back = null,
        string $method = 'post',
        string $blade = null,
        string $otherButtonLabel = null,
        string $otherButtonHref = null,
        string $submitButtonType = Page::NORMAL_BUTTON
    ): Page {
        return Page::create($title)
            ->setAction($action)
            ->setBack($back)
            ->setSubmitButtonLabel($submitButtonLabel)
            ->setSubmitButtonType($submitButtonType)
            ->setOtherButtonHref($otherButtonHref)
            ->setOtherButtonLabel($otherButtonLabel ?? Page::OTHER_BUTTON_LABEL)
            ->setContent($blade)
            ->setMethod($method)
            ->setSummary($summary)
            ->setTemplate('summary');
    }

    public static function tasklist(string $title): Page
    {
        // TODO
        return Page::create($title);
    }
}
