<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use InvalidArgumentException;

class SpanOrMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "span_or": {
                    "clauses": [
                        { "span_term": { "field1": "value1" } },
                        { "span_term": { "field2": "value2" } }
                    ]
                }
            }',
            new SpanOrMatcher([
                new SpanTermMatcher('field1', 'value1'),
                new SpanTermMatcher('field2', 'value2'),
            ]),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new SpanOrMatcher([
            new SpanTermMatcher('field1', 'value1'),
            new SpanTermMatcher('field2', 'value2'),
        ]);
        $this->assertInstanceOf(SpanOrMatcher::class, $matcher1);

        $this->expectException(InvalidArgumentException::class);
        new SpanOrMatcher([]);
    }
}
