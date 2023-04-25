<?php

namespace AnthonyEdmonds\GovukLaravel\CommonMark;

use League\CommonMark\Extension\Table\TableCell;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

final class TableCellRenderer implements NodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
    {
        TableCell::assertInstanceOf($node);

        $attrs = $node->data->get('attributes');

        $tag = $node->getType() === TableCell::TYPE_HEADER ? 'th' : 'td';

        $attrs['class'] = $tag === 'th'
            ? 'govuk-table__header'
            : 'govuk-table__cell';

        if ($node->getAlign() === 'right') {
            $attrs['class'] .= $tag === 'th'
                ? ' govuk-table__header--numeric'
                : ' govuk-table__cell--numeric';
        }

        return new HtmlElement($tag, $attrs, $childRenderer->renderNodes($node->children()));
    }
}
