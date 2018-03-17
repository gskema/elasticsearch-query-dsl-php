<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\PrefixMatcher;

class SpanMultiMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "span_multi": {
                    "match": { "prefix": { "field1": "prefix1" } }
                }
            }',
            new SpanMultiMatcher(
                new PrefixMatcher('field1', 'prefix1')
            ),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new SpanMultiMatcher(
            new PrefixMatcher('field1', 'prefix1')
        );
        $this->assertInstanceOf(SpanMultiMatcher::class, $matcher1);
    }
}
