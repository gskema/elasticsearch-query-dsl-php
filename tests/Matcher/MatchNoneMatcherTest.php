<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class MatchNoneMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "match_none": {}
            }',
            new MatchNoneMatcher(),
        ];

        return $dataSets;
    }
}
