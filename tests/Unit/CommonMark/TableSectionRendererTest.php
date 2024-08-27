<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\CommonMark;

use AnthonyEdmonds\GovukLaravel\CommonMark\TableCellRenderer;
use AnthonyEdmonds\GovukLaravel\CommonMark\TableSectionRenderer;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Table\TableCell;
use League\CommonMark\Extension\Table\TableSection;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\HtmlRenderer;
use League\CommonMark\Util\HtmlElement;

class TableSectionRendererTest extends TestCase
{
    protected ChildNodeRendererInterface $child;

    protected TableSectionRenderer $renderer;

    protected HtmlElement|string $element;

    protected Environment $environment;

    protected Node $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->environment = new Environment;
        $this->environment->addRenderer(TableCell::class, new TableCellRenderer);

        $this->child = new HtmlRenderer($this->environment);
        $this->renderer = new TableSectionRenderer;
    }

    public function testStringWhenNoChildren(): void
    {
        $this->makeSection(TableSection::TYPE_BODY, false);

        $this->assertIsString($this->element);
    }

    public function testHasTbody(): void
    {
        $this->makeSection(TableSection::TYPE_BODY);

        $this->assertEquals(
            'tbody',
            $this->element->getTagName(),
        );

        $this->assertEquals(
            'govuk-table__body',
            $this->element->getAttribute('class'),
        );
    }

    public function testHasThead(): void
    {
        $this->makeSection(TableSection::TYPE_HEAD);

        $this->assertEquals(
            'thead',
            $this->element->getTagName(),
        );

        $this->assertEquals(
            'govuk-table__head',
            $this->element->getAttribute('class'),
        );
    }

    protected function makeSection(string $type, bool $children = true): void
    {
        $this->node = new TableSection($type);

        if ($children === true) {
            $this->node->appendChild(new TableCell);
        }

        $this->element = $this->renderer->render($this->node, $this->child);
    }
}
