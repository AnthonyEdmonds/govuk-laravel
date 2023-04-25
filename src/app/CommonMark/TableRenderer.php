<?php

namespace AnthonyEdmonds\GovukLaravel\CommonMark;

use League\CommonMark\Extension\Table\Table;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class TableRenderer implements NodeRendererInterface
{
    /**
     * @param  Table  $node
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
    {
        Table::assertInstanceOf($node);

        $attrs = $node->data->get('attributes');
        $attrs['class'] = 'govuk-table';

        $separator = $childRenderer->getInnerSeparator();

        $children = $childRenderer->renderNodes($node->children());

        return new HtmlElement('table', $attrs, $separator.trim($children).$separator);
    }
}
