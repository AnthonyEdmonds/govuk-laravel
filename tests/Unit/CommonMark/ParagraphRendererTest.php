<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\CommonMark;

use AnthonyEdmonds\GovukLaravel\CommonMark\ParagraphRenderer;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\Node\Block\ListData;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\HtmlRenderer;
use League\CommonMark\Util\HtmlElement;

class ParagraphRendererTest extends TestCase
{
    protected ChildNodeRendererInterface $child;

    protected ParagraphRenderer $renderer;

    protected HtmlElement $element;

    protected Environment $environment;

    protected Node $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->environment = new Environment();
        $this->node = new Paragraph();
        $this->child = new HtmlRenderer($this->environment);

        $this->renderer = new ParagraphRenderer();
        $this->element = $this->renderer->render($this->node, $this->child);
    }

    public function testHasTag(): void
    {
        $this->assertEquals(
            'p',
            $this->element->getTagName(),
        );
    }

    public function testHasClass(): void
    {
        $this->assertEquals(
            'govuk-body',
            $this->element->getAttribute('class'),
        );
    }

    public function testStringWhenParentIsList(): void
    {
        $list = new ListItem(new ListData());
        $list->appendChild($this->node);

        $this->assertIsString(
            $this->renderer->render($this->node, $this->child),
        );
    }
}
