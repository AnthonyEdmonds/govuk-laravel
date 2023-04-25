<?php

namespace AnthonyEdmonds\GovukLaravel\CommonMark;

use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Util\Xml;

class FencedCodeRenderer implements NodeRendererInterface
{
    /**
     * @param  FencedCode  $node
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
    {
        FencedCode::assertInstanceOf($node);

        $attrs = $node->data->getData('attributes');

        $infoWords = $node->getInfoWords();
        if (count($infoWords) !== 0 && $infoWords[0] !== '') {
            $attrs->append('class', 'language-'.$infoWords[0]);
        }

        return new HtmlElement(
            'pre',
            [
                'class' => 'govuk-body',
            ],
            new HtmlElement('code', $attrs->export(), Xml::escape($node->getLiteral()))
        );
    }
}
