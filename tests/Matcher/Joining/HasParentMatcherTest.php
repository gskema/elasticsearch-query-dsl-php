<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticSearchQueryDSL\SearchRequest\InnerHitsRequest;

class HasParentMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "has_parent": {
                    "parent_type": "parentType1",
                    "query": { "match_all": {} }
                }
            }',
            new HasParentMatcher('parentType1', new MatchAllMatcher()),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "has_parent": {
                    "parent_type": "parentType1",
                    "query": { "match_all": {} },
                    "inner_hits": {
                        "name": "name1"
                    }
                }
            }',
            (new HasParentMatcher('parentType1', new MatchAllMatcher()))
                ->setInnerHits((new InnerHitsRequest())->setName('name1')),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new HasParentMatcher('parentType1', new MatchAllMatcher());
        $this->assertInstanceOf(HasParentMatcher::class, $matcher1);
    }
}
