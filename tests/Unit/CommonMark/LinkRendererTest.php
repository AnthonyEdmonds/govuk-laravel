<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\CommonMark;

use AnthonyEdmonds\GovukLaravel\CommonMark\LinkRenderer;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Node\Inline\Text;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\HtmlRenderer;
use League\CommonMark\Renderer\Inline\TextRenderer;
use League\CommonMark\Util\HtmlElement;

class LinkRendererTest extends TestCase
{
    protected ChildNodeRendererInterface $child;

    protected LinkRenderer $renderer;

    protected HtmlElement $element;

    protected Environment $environment;

    protected Node $node;

    protected function setUp(): void
    {
        parent::setUp();

        $this->environment = new Environment;
        $this->environment->addRenderer(Text::class, new TextRenderer);

        $this->child = new HtmlRenderer($this->environment);

        $this->renderer = new LinkRenderer;
    }

    public function testHasTag(): void
    {
        $this->makeLink();

        $this->assertEquals(
            'a',
            $this->element->getTagName(),
        );
    }

    public function testHasClass(): void
    {
        $this->makeLink();

        $this->assertEquals(
            'govuk-link',
            $this->element->getAttribute('class'),
        );
    }

    public function testHasHref(): void
    {
        $this->makeLink();

        $this->assertEquals(
            config('app.url'),
            $this->element->getAttribute('href'),
        );
    }

    public function testHasAdditionsWhenExternal(): void
    {
        $this->makeLink(true);

        $this->assertEquals(
            'noopener noreferrer',
            $this->element->getAttribute('rel'),
        );

        $this->assertEquals(
            '_blank',
            $this->element->getAttribute('target'),
        );

        $this->assertStringEndsWith(
            ' (opens in a new tab)',
            $this->element->getContents(),
        );
    }

    protected function makeLink(bool $external = false): void
    {
        $this->node = new Link($external === true ? 'www.blah.com' : config('app.url'));
        $this->node->appendChild(new Text('My text'));
        $this->element = $this->renderer->render($this->node, $this->child);
    }
}
