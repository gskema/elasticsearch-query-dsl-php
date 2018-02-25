<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class MatchAllMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "match_all": {}
            }',
            new MatchAllMatcher(),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "match_all": {
                    "boost": 1.0
                }
            }',
            new MatchAllMatcher(['boost' => 1.0]),
        ];
        return $dataSets;
    }
}
