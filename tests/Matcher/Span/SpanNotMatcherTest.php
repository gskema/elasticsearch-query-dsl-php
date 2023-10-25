<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class SpanNotMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $matcher1 = new SpanNotMatcher(
            new SpanTermMatcher('field1', 'value1'),
            new SpanTermMatcher('field2', 'value2'),
            ['pre' => 1]
        );
        self::assertInstanceOf(SpanNotMatcher::class, $matcher1);
    }
}
