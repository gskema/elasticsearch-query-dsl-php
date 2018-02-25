<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class MultiMatchMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "multi_match": {
                    "query": "query1",
                    "fields": ["field1", "field2"],
                    "minimum_should_match": 2
                }
             }',
            new MultiMatchMatcher(['field1', 'field2'], 'query1', ['minimum_should_match' => 2]),
        ];

        return $dataSets;
    }
}
