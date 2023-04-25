<?php

namespace AnthonyEdmonds\GovukLaravel\CommonMark;

use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Util\Xml;

class IndentedCodeRenderer implements NodeRendererInterface
{
    /**
     * @param  IndentedCode  $node
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
    {
        IndentedCode::assertInstanceOf($node);

        $attrs = $node->data->get('attributes');

        return new HtmlElement(
            'pre',
            [
                'class' => 'govuk-body',
            ],
            new HtmlElement('code', $attrs, Xml::escape($node->getLiteral()))
        );
    }
}
