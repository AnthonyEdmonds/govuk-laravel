<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\CommonMark;

use AnthonyEdmonds\GovukLaravel\CommonMark\ListBlockRenderer;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\Node\Block\ListBlock;
use League\CommonMark\Extension\CommonMark\Node\Block\ListData;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\HtmlRenderer;
use League\CommonMark\Util\HtmlElement;

class ListBlockRendererTest extends TestCase
{
    protected ChildNodeRendererInterface $child;

    protected ListBlockRenderer $renderer;

    protected ListData $listData;

    protected HtmlElement $element;

    protected Environment $environment;

    protected Node $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->environment = new Environment;

        $this->listData = new ListData;
        $this->node = new ListBlock($this->listData);
        $this->child = new HtmlRenderer($this->environment);

        $this->renderer = new ListBlockRenderer;

    }

    public function testHasUl(): void
    {
        $this->makeList(ListBlock::TYPE_BULLET);

        $this->assertEquals(
            'ul',
            $this->element->getTagName(),
        );

        $this->assertEquals(
            'govuk-list govuk-list--bullet',
            $this->element->getAttribute('class'),
        );
    }

    public function testHasOl(): void
    {
        $this->makeList(ListBlock::TYPE_ORDERED);

        $this->assertEquals(
            'ol',
            $this->element->getTagName(),
        );

        $this->assertEquals(
            'govuk-list govuk-list--number',
            $this->element->getAttribute('class'),
        );
    }

    protected function makeList(string $type): void
    {
        $this->listData->type = $type;
        $this->element = $this->renderer->render($this->node, $this->child);
    }
}
