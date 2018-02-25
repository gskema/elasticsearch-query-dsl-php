<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;

class HasParentMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "has_parent": {
                    "parent_type": "parentType1",
                    "query": { "match_all": {} }
                }
            }',
            new HasParentMatcher('parentType1', new MatchAllMatcher()),
        ];

        return $dataSets;
    }
}
