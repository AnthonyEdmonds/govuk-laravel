<?php

namespace AnthonyEdmonds\GovukLaravel\CommonMark;

use League\CommonMark\Extension\Table\TableSection;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class TableSectionRenderer implements NodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement|string
    {
        TableSection::assertInstanceOf($node);

        if (! $node->hasChildren()) {
            return '';
        }

        $attrs = $node->data->get('attributes');

        $separator = $childRenderer->getInnerSeparator();

        $tag = $node->getType() === TableSection::TYPE_HEAD ? 'thead' : 'tbody';

        $attrs['class'] = $tag === 'thead'
            ? 'govuk-table__head'
            : 'govuk-table__body';

        return new HtmlElement($tag, $attrs, $separator.$childRenderer->renderNodes($node->children()).$separator);
    }
}
