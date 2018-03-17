<?php

namespace Gskema\ElasticSearchQueryDSL\SearchRequest;

use Gskema\ElasticSearchQueryDSL\Highlighter\Highlighter;
use PHPUnit\Framework\TestCase;

class HasHighlighterTraitTest extends TestCase
{
    public function testMethods()
    {
        /** @var HasHighlighterTrait $object */
        $object = $this->getMockBuilder(HasHighlighterTrait::class)->getMockForTrait();

        $object->setHighlighter(new Highlighter(['opt1' => 'val1']));

        $this->assertEquals(new Highlighter(['opt1' => 'val1']), $object->getHighlighter());
    }
}
