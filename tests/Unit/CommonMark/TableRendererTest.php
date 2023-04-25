<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\CommonMark;

use AnthonyEdmonds\GovukLaravel\CommonMark\TableRenderer;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Table\Table;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\HtmlRenderer;
use League\CommonMark\Util\HtmlElement;

class TableRendererTest extends TestCase
{
    protected ChildNodeRendererInterface $child;

    protected TableRenderer $renderer;

    protected HtmlElement $element;

    protected Environment $environment;

    protected Node $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->environment = new Environment();
        $this->node = new Table();
        $this->child = new HtmlRenderer($this->environment);

        $this->renderer = new TableRenderer();
        $this->element = $this->renderer->render($this->node, $this->child);
    }

    public function testHasTag(): void
    {
        $this->assertEquals(
            'table',
            $this->element->getTagName(),
        );
    }

    public function testHasClass(): void
    {
        $this->assertEquals(
            'govuk-table',
            $this->element->getAttribute('class'),
        );
    }
}
