<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\FullText;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class MatchPhraseMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "match_phrase": {
                    "field1": {
                        "query": "query1"
                    }
                }
             }',
            new MatchPhraseMatcher('field1', 'query1'),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new MatchPhraseMatcher('field1', 'query1');
        $this->assertInstanceOf(MatchPhraseMatcher::class, $matcher1);
    }
}
