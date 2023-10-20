<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use InvalidArgumentException;

final class SpanNearMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $matcher1 = new SpanNearMatcher(
            [
                new SpanTermMatcher('field1', 'value1'),
                new SpanTermMatcher('field2', 'value2'),
            ],
            5,
            false
        );
        self::assertInstanceOf(SpanNearMatcher::class, $matcher1);

        $this->expectException(InvalidArgumentException::class);
        new SpanNearMatcher([], 5, false);
    }
}
