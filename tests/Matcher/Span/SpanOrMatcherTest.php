<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use InvalidArgumentException;

final class SpanOrMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $matcher1 = new SpanOrMatcher([
            new SpanTermMatcher('field1', 'value1'),
            new SpanTermMatcher('field2', 'value2'),
        ]);
        self::assertInstanceOf(SpanOrMatcher::class, $matcher1);

        $this->expectException(InvalidArgumentException::class);
        new SpanOrMatcher([]);
    }
}
