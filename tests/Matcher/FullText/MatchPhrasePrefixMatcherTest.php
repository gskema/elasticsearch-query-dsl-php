<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class MatchPhrasePrefixMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "match_phrase_prefix": {
                    "field1": {
                        "query": "query1",
                        "max_expansions": 10
                    }
                }
             }',
            new MatchPhrasePrefixMatcher('field1', 'query1', ['max_expansions' => 10]),
        ];

        return $dataSets;
    }
}
