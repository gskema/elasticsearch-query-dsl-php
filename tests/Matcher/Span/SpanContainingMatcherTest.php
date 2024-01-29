<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Span;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class SpanContainingMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "span_containing": {
                    "little": { "span_term" : { "field1": "value1" } },
                    "big": { "span_term" : { "field2": "value2" } }
                }
            }',
            new SpanContainingMatcher(
                new SpanTermMatcher('field1', 'value1'),
                new SpanTermMatcher('field2', 'value2')
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new SpanContainingMatcher(
            new SpanTermMatcher('field1', 'value1'),
            new SpanTermMatcher('field2', 'value2')
        );
        self::assertInstanceOf(SpanContainingMatcher::class, $matcher1);
    }
}
