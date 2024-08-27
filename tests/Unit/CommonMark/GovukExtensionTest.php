<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\CommonMark;

use AnthonyEdmonds\GovukLaravel\CommonMark\BlockQuoteRenderer;
use AnthonyEdmonds\GovukLaravel\CommonMark\CodeRenderer;
use AnthonyEdmonds\GovukLaravel\CommonMark\FencedCodeRenderer;
use AnthonyEdmonds\GovukLaravel\CommonMark\GovukExtension;
use AnthonyEdmonds\GovukLaravel\CommonMark\HeadingRenderer;
use AnthonyEdmonds\GovukLaravel\CommonMark\IndentedCodeRenderer;
use AnthonyEdmonds\GovukLaravel\CommonMark\LinkRenderer;
use AnthonyEdmonds\GovukLaravel\CommonMark\ListBlockRenderer;
use AnthonyEdmonds\GovukLaravel\CommonMark\ParagraphRenderer;
use AnthonyEdmonds\GovukLaravel\CommonMark\TableCellRenderer;
use AnthonyEdmonds\GovukLaravel\CommonMark\TableRenderer;
use AnthonyEdmonds\GovukLaravel\CommonMark\TableRowRenderer;
use AnthonyEdmonds\GovukLaravel\CommonMark\TableSectionRenderer;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\Node\Block\BlockQuote;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\ListBlock;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
use League\CommonMark\Extension\Table\Table;
use League\CommonMark\Extension\Table\TableCell;
use League\CommonMark\Extension\Table\TableRow;
use League\CommonMark\Extension\Table\TableSection;
use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\Util\PrioritizedList;
use ReflectionClass;

class GovukExtensionTest extends TestCase
{
    const EXPECTED_EXTENSIONS = [
        StrikethroughExtension::class,
    ];

    const EXPECTED_RENDERERS = [
        BlockQuote::class => BlockQuoteRenderer::class,
        Code::class => CodeRenderer::class,
        FencedCode::class => FencedCodeRenderer::class,
        Heading::class => HeadingRenderer::class,
        IndentedCode::class => IndentedCodeRenderer::class,
        Link::class => LinkRenderer::class,
        ListBlock::class => ListBlockRenderer::class,
        Paragraph::class => ParagraphRenderer::class,
        Table::class => TableRenderer::class,
        TableCell::class => TableCellRenderer::class,
        TableRow::class => TableRowRenderer::class,
        TableSection::class => TableSectionRenderer::class,
    ];

    protected Environment $environment;

    protected GovukExtension $extension;

    protected function setUp(): void
    {
        parent::setUp();

        $this->environment = new Environment;

        $this->extension = new GovukExtension;
        $this->extension->register($this->environment);
    }

    public function testHasExtensions(): void
    {
        $extensions = $this->environment->getExtensions();

        foreach (self::EXPECTED_EXTENSIONS as $expected) {
            foreach ($extensions as $extension) {
                if (is_a($extension, $expected) === true) {
                    $this->assertInstanceOf(
                        $expected,
                        $extension,
                    );

                    continue 2;
                }
            }

            $this->fail('Extension not loaded');
        }
    }

    public function testHasRenderers(): void
    {
        foreach (self::EXPECTED_RENDERERS as $type => $expected) {
            $renderers = $this->environment->getRenderersForClass($type);
            $mirror = new ReflectionClass(PrioritizedList::class);

            $this->assertInstanceOf(
                $expected,
                $mirror->getProperty('list')->getValue($renderers)[0][0],
            );
        }
    }
}
