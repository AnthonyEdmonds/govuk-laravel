<?php

namespace AnthonyEdmonds\GovukLaravel\CommonMark;

use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class HeadingRenderer implements NodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
    {
        switch ($node->getLevel()) {
            case 4:
                $tag = 'h4';
                $class = 'govuk-heading-s';
                break;

            case 3:
                $tag = 'h3';
                $class = 'govuk-heading-s';
                break;

            case 2:
                $tag = 'h2';
                $class = 'govuk-heading-m';
                break;

            case 1:
            default:
                $tag = 'h1';
                $class = 'govuk-heading-l';
                break;
        }

        return new HtmlElement(
            $tag,
            [
                'class' => $class,
            ],
            $childRenderer->renderNodes($node->children()),
        );
    }
}
