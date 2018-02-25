<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;

class HasChildMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "has_child": {
                    "type": "childType1",
                    "query": { "match_all": {} }
                }
             }',
            new HasChildMatcher('childType1', new MatchAllMatcher()),
        ];

        return $dataSets;
    }
}
