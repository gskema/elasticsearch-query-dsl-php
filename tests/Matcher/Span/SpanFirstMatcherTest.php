<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class SpanFirstMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $matcher1 = new SpanFirstMatcher(
            new SpanTermMatcher('field1', 'value1'),
            3
        );
        self::assertInstanceOf(SpanFirstMatcher::class, $matcher1);
    }
}
