<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\CommonMark;

use AnthonyEdmonds\GovukLaravel\CommonMark\IndentedCodeRenderer;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\HtmlRenderer;
use League\CommonMark\Util\HtmlElement;

class IndentedCodeRendererTest extends TestCase
{
    protected ChildNodeRendererInterface $child;

    protected IndentedCodeRenderer $renderer;

    protected HtmlElement $element;

    protected Environment $environment;

    protected Node $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->environment = new Environment;
        $this->node = new IndentedCode;
        $this->child = new HtmlRenderer($this->environment);

        $this->renderer = new IndentedCodeRenderer;
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
