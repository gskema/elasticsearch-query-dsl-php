<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchNoneMatcher;

class IndicesMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "indices": {
                    "indices": ["index1", "index2"],
                    "query": { "match_all": {} },
                    "no_match_query": { "match_none": {} }
                }
             }',
            new IndicesMatcher(
                ['index1', 'index2'],
                new MatchAllMatcher(),
                new MatchNoneMatcher()
            ),
        ];

        return $dataSets;
    }
}
