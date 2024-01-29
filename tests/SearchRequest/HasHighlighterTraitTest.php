<?php

namespace Gskema\ElasticsearchQueryDSL\SearchRequest;

use Gskema\ElasticsearchQueryDSL\Highlighter\Highlighter;
use PHPUnit\Framework\TestCase;

final class HasHighlighterTraitTest extends TestCase
{
    public function testMethods(): void
    {
        /** @var HasHighlighterTrait $object */
        $object = new class {
            use HasHighlighterTrait;
        };

        $object->setHighlighter(new Highlighter(options: ['opt1' => 'val1']));

        self::assertEquals(new Highlighter(options: ['opt1' => 'val1']), $object->getHighlighter());
    }
}
