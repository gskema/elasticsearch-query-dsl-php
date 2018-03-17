<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class MatchMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "match": {
                    "field1": {
                        "query": "query1"
                    }
                }
             }',
            new MatchMatcher('field1', 'query1'),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new MatchMatcher('field1', 'query1');
        $this->assertInstanceOf(MatchMatcher::class, $matcher1);
    }
}
