<?php

namespace AnthonyEdmonds\GovukLaravel\CommonMark;

use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Node\Inline\Text;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class LinkRenderer implements NodeRendererInterface
{
    /**
     * @param  Link  $node
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
    {
        Link::assertInstanceOf($node);

        $attrs = [];

        $attrs['class'] = 'govuk-link';
        $attrs['href'] = $node->getUrl();

        if (str_starts_with($attrs['href'], config('app.url')) === false) {
            $attrs['rel'] = 'noopener noreferrer';
            $attrs['target'] = '_blank';

            $node->appendChild(new Text(' (opens in a new tab)'));
        }

        return new HtmlElement('a', $attrs, $childRenderer->renderNodes($node->children()));
    }
}
