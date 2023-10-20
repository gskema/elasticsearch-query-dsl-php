<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class SpanWithinMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "span_within": {
                    "little": { "span_term" : { "field1": "value1" } },
                    "big": { "span_term" : { "field2": "value2" } }
                }
            }',
            new SpanWithinMatcher(
                new SpanTermMatcher('field1', 'value1'),
                new SpanTermMatcher('field2', 'value2')
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new SpanWithinMatcher(
            new SpanTermMatcher('field1', 'value1'),
            new SpanTermMatcher('field2', 'value2')
        );
        self::assertInstanceOf(SpanWithinMatcher::class, $matcher1);
    }
}
