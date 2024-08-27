<?php

namespace AnthonyEdmonds\GovukLaravel\CommonMark;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark\Node\Block\BlockQuote;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\ListBlock;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
use League\CommonMark\Extension\Table\Table;
use League\CommonMark\Extension\Table\TableCell;
use League\CommonMark\Extension\Table\TableRow;
use League\CommonMark\Extension\Table\TableSection;
use League\CommonMark\Node\Block\Paragraph;

class GovukExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment
            ->addExtension(new StrikethroughExtension)
            ->addRenderer(BlockQuote::class, new BlockQuoteRenderer)
            ->addRenderer(Code::class, new CodeRenderer)
            ->addRenderer(FencedCode::class, new FencedCodeRenderer)
            ->addRenderer(Heading::class, new HeadingRenderer)
            ->addRenderer(IndentedCode::class, new IndentedCodeRenderer)
            ->addRenderer(Link::class, new LinkRenderer)
            ->addRenderer(ListBlock::class, new ListBlockRenderer)
            ->addRenderer(Paragraph::class, new ParagraphRenderer)
            ->addRenderer(Table::class, new TableRenderer)
            ->addRenderer(TableCell::class, new TableCellRenderer)
            ->addRenderer(TableRow::class, new TableRowRenderer)
            ->addRenderer(TableSection::class, new TableSectionRenderer);
    }
}
