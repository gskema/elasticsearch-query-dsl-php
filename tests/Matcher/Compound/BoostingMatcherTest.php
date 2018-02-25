<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermMatcher;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\WildcardMatcher;

class BoostingMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "boosting": {
                    "positive": { "wildcard": { "field1": "value1*" } },
                    "negative": { "term" : { "field1": "value1" } },
                    "negative_boost": 0.5
                }
             }',
            new BoostingMatcher(
                new WildcardMatcher('field1', 'value1*'),
                new TermMatcher('field1', "value1"),
                0.5
            ),
        ];

        return $dataSets;
    }
}
