<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class SpanNotMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "span_not": {
                    "include": { "span_term": { "field1": "value1" } },
                    "exclude": { "span_term": { "field2": "value2" } },
                    "pre": 1
                }
            }',
            new SpanNotMatcher(
                new SpanTermMatcher('field1', 'value1'),
                new SpanTermMatcher('field2', 'value2'),
                ['pre' => 1]
            ),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new SpanNotMatcher(
            new SpanTermMatcher('field1', 'value1'),
            new SpanTermMatcher('field2', 'value2'),
            ['pre' => 1]
        );
        $this->assertInstanceOf(SpanNotMatcher::class, $matcher1);
    }
}
