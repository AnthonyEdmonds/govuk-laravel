<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\CommonMark;

use AnthonyEdmonds\GovukLaravel\CommonMark\TableRowRenderer;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Table\TableRow;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\HtmlRenderer;
use League\CommonMark\Util\HtmlElement;

class TableRowRendererTest extends TestCase
{
    protected ChildNodeRendererInterface $child;

    protected TableRowRenderer $renderer;

    protected HtmlElement $element;

    protected Environment $environment;

    protected Node $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->environment = new Environment();
        $this->node = new TableRow();
        $this->child = new HtmlRenderer($this->environment);

        $this->renderer = new TableRowRenderer();
        $this->element = $this->renderer->render($this->node, $this->child);
    }

    public function testHasTag(): void
    {
        $this->assertEquals(
            'tr',
            $this->element->getTagName(),
        );
    }

    public function testHasClass(): void
    {
        $this->assertEquals(
            'govuk-table__row',
            $this->element->getAttribute('class'),
        );
    }
}
