<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class SpanContainingMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
}
