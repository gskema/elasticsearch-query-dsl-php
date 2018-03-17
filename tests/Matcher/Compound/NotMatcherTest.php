<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Compound;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;

class NotMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "bool": {
                    "must_not": {
                        "match_all": {}
                    }
                }
             }',
            new NotMatcher(new MatchAllMatcher()),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new NotMatcher(new MatchAllMatcher());
        $this->assertInstanceOf(NotMatcher::class, $matcher1);
    }
}
