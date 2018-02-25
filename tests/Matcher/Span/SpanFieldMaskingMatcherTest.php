<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class SpanFieldMaskingMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
}
