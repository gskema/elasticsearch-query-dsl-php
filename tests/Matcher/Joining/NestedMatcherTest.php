<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;

class NestedMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "nested": {
                    "path": "path1",
                    "query": { "match_all": {} }
                }
            }',
            new NestedMatcher('path1', new MatchAllMatcher()),
        ];

        return $dataSets;
    }
}
