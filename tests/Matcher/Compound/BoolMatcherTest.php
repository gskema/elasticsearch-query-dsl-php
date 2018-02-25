<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticSearchQueryDSL\Matcher\TermLevel\TermMatcher;

class BoolMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "bool": {}
            }',
            new BoolMatcher(),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "bool": {
                    "filter": [
                        { "term" : { "field1": "value1" } },
                        { "term" : { "field2": "value2" } }
                    ],
                    "must_not": { "match_all": {} }
                }
            }',
            (new BoolMatcher())
            ->addFilter(new TermMatcher('field1', 'value1'))
            ->addFilter(new TermMatcher('field2', 'value2'))
            ->addMustNot(new MatchAllMatcher()),
        ];

        return $dataSets;
    }
}
