<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\CommonMark;

use AnthonyEdmonds\GovukLaravel\CommonMark\TableCellRenderer;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Table\TableCell;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\HtmlRenderer;
use League\CommonMark\Util\HtmlElement;

class TableCellRendererTest extends TestCase
{
    protected ChildNodeRendererInterface $child;

    protected TableCellRenderer $renderer;

    protected HtmlElement $element;

    protected Environment $environment;

    protected Node $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->environment = new Environment;
        $this->child = new HtmlRenderer($this->environment);
        $this->renderer = new TableCellRenderer;
    }

    public function testHasTd(): void
    {
        $this->makeCell(TableCell::TYPE_DATA);

        $this->assertEquals(
            'td',
            $this->element->getTagName(),
        );

        $this->assertEquals(
            'govuk-table__cell',
            $this->element->getAttribute('class'),
        );
    }

    public function testHasTdAlignedRight(): void
    {
        $this->makeCell(TableCell::TYPE_DATA, TableCell::ALIGN_RIGHT);

        $this->assertStringContainsString(
            'govuk-table__cell--numeric',
            $this->element->getAttribute('class'),
        );
    }

    public function testHasTh(): void
    {
        $this->makeCell(TableCell::TYPE_HEADER);

        $this->assertEquals(
            'th',
            $this->element->getTagName(),
        );

        $this->assertEquals(
            'govuk-table__header',
            $this->element->getAttribute('class'),
        );
    }

    public function testHasThAlignedRight(): void
    {
        $this->makeCell(TableCell::TYPE_HEADER, TableCell::ALIGN_RIGHT);

        $this->assertStringContainsString(
            'govuk-table__header--numeric',
            $this->element->getAttribute('class'),
        );
    }

    protected function makeCell(string $type, ?string $align = null): void
    {
        $this->node = new TableCell($type, $align);
        $this->element = $this->renderer->render($this->node, $this->child);
    }
}
