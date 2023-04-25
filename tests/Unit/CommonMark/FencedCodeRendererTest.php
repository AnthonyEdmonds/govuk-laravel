<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\CommonMark;

use AnthonyEdmonds\GovukLaravel\CommonMark\FencedCodeRenderer;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\HtmlRenderer;
use League\CommonMark\Util\HtmlElement;

class FencedCodeRendererTest extends TestCase
{
    protected ChildNodeRendererInterface $child;

    protected FencedCodeRenderer $renderer;

    protected HtmlElement $element;

    protected Environment $environment;

    protected Node $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->environment = new Environment();
        $this->node = new FencedCode(10, '`', 0);
        $this->child = new HtmlRenderer($this->environment);

        $this->renderer = new FencedCodeRenderer();
        $this->element = $this->renderer->render($this->node, $this->child);
    }

    public function testHasTag(): void
    {
        $this->assertEquals(
            'pre',
            $this->element->getTagName(),
        );

        $this->assertEquals(
            'code',
            $this->element->getContents(false)->getTagName(),
        );
    }

    public function testHasClass(): void
    {
        $this->assertEquals(
            'govuk-body',
            $this->element->getAttribute('class'),
        );
    }
}
