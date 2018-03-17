<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class SimpleQueryStringMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "simple_query_string": {
                    "query": "this AND that OR thus",
                    "all_fields": true
                }
             }',
            new SimpleQueryStringMatcher('this AND that OR thus', ['all_fields' => true]),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new SimpleQueryStringMatcher('this AND that OR thus', ['all_fields' => true]);
        $this->assertInstanceOf(SimpleQueryStringMatcher::class, $matcher1);
    }
}
