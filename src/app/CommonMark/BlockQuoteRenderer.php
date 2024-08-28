<?php

namespace AnthonyEdmonds\GovukLaravel\CommonMark;

use League\CommonMark\Extension\CommonMark\Node\Block\BlockQuote;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class BlockQuoteRenderer implements NodeRendererInterface
{
    /**
     * @param  BlockQuote  $node
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
    {
        BlockQuote::assertInstanceOf($node);

        $attrs = $node->data->get('attributes');
        $attrs['class'] = 'govuk-inset-text';

        $filling = $childRenderer->renderNodes($node->children());
        $innerSeparator = $childRenderer->getInnerSeparator();

        if ($filling === '') {
            return new HtmlElement('blockquote', $attrs, $innerSeparator);
        }

        return new HtmlElement(
            'blockquote',
            $attrs,
            $innerSeparator . $filling . $innerSeparator,
        );
    }
}
