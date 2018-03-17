<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use InvalidArgumentException;

class SpanNearMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "span_near": {
                    "clauses": [
                        { "span_term": { "field1": "value1" } },
                        { "span_term": { "field2": "value2" } }
                    ],
                    "slop": 5,
                    "in_order": false
                }
            }',
            new SpanNearMatcher(
                [
                    new SpanTermMatcher('field1', 'value1'),
                    new SpanTermMatcher('field2', 'value2'),
                ],
                5,
                false
            ),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new SpanNearMatcher(
            [
                new SpanTermMatcher('field1', 'value1'),
                new SpanTermMatcher('field2', 'value2'),
            ],
            5,
            false
        );
        $this->assertInstanceOf(SpanNearMatcher::class, $matcher1);

        $this->expectException(InvalidArgumentException::class);
        new SpanNearMatcher([], 5, false);
    }
}
