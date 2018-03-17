<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;

class ConstantScoreMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "constant_score": {
                    "filter": { "match_all": {} },
                    "boost": 5
                }
            }',
            new ConstantScoreMatcher(
                new MatchAllMatcher(),
                5
            ),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new ConstantScoreMatcher(
            new MatchAllMatcher(),
            5
        );
        $this->assertInstanceOf(ConstantScoreMatcher::class, $matcher1);
    }
}
