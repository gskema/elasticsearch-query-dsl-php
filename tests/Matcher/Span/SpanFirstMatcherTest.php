<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class SpanFirstMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "span_first": {
                    "match" : { "span_term": { "field1": "value1" } },
                    "end": 3
                }
            }',
            new SpanFirstMatcher(
                new SpanTermMatcher('field1', 'value1'),
                3
            ),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new SpanFirstMatcher(
            new SpanTermMatcher('field1', 'value1'),
            3
        );
        $this->assertInstanceOf(SpanFirstMatcher::class, $matcher1);
    }
}
