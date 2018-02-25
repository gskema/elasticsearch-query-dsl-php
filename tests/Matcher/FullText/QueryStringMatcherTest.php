<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class QueryStringMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "query_string": {
                    "query": "this AND that OR thus",
                    "default_field": "body"
                }
             }',
            new QueryStringMatcher('this AND that OR thus', ['default_field' => 'body']),
        ];

        return $dataSets;
    }
}
