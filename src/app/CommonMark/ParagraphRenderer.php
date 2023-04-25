<?php

namespace AnthonyEdmonds\GovukLaravel\CommonMark;

use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class ParagraphRenderer implements NodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement|string
    {
        return is_a($node->parent(), ListItem::class)
            ? $childRenderer->renderNodes($node->children())
            : new HtmlElement(
                'p',
                [
                    'class' => 'govuk-body',
                ],
                $childRenderer->renderNodes($node->children()),
            );
    }
}
