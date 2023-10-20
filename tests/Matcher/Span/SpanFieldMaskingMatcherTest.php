<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class SpanFieldMaskingMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "field_masking_span": {
                    "query": {
                        "span_term": { "field2": "value2" }
                    },
                    "field": "field1"
                }
            }',
            new SpanFieldMaskingMatcher(
                'field1',
                new SpanTermMatcher('field2', 'value2')
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new SpanFieldMaskingMatcher(
            'field1',
            new SpanTermMatcher('field2', 'value2')
        );
        self::assertInstanceOf(SpanFieldMaskingMatcher::class, $matcher1);
    }
}
