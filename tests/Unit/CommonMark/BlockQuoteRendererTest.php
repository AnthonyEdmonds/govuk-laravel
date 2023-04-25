<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\CommonMark;

use AnthonyEdmonds\GovukLaravel\CommonMark\BlockQuoteRenderer;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\Node\Block\BlockQuote;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\HtmlRenderer;
use League\CommonMark\Util\HtmlElement;

class BlockQuoteRendererTest extends TestCase
{
    protected ChildNodeRendererInterface $child;

    protected BlockQuoteRenderer $renderer;

    protected HtmlElement $element;

    protected Environment $environment;

    protected Node $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->environment = new Environment();
        $this->node = new BlockQuote();
        $this->child = new HtmlRenderer($this->environment);

        $this->renderer = new BlockQuoteRenderer();
        $this->element = $this->renderer->render($this->node, $this->child);
    }

    public function testHasTag(): void
    {
        $this->assertEquals(
            'blockquote',
            $this->element->getTagName(),
        );
    }

    public function testHasClass(): void
    {
        $this->assertEquals(
            'govuk-inset-text',
            $this->element->getAttribute('class'),
        );
    }
}
