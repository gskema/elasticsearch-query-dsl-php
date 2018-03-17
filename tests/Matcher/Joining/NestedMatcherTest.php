<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticSearchQueryDSL\SearchRequest\InnerHitsRequest;

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

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "nested": {
                    "path": "path1",
                    "query": { "match_all": {} },
                    "inner_hits": {
                        "name": "name1"
                    }
                }
            }',
            (new NestedMatcher('path1', new MatchAllMatcher()))
                ->setInnerHits((new InnerHitsRequest())->setName('name1')),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new NestedMatcher('path1', new MatchAllMatcher());
        $this->assertInstanceOf(NestedMatcher::class, $matcher1);
    }
}
