<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Span;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class SpanTermMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "span_term" : {
                    "field1": "value1"
                }
            }',
            new SpanTermMatcher('field1', 'value1'),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new SpanTermMatcher('field1', 'value1');
        $this->assertInstanceOf(SpanTermMatcher::class, $matcher1);
    }
}
