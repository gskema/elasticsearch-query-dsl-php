<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticSearchQueryDSL\SearchRequest\InnerHits\InnerHitsRequest;

final class HasParentMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $matcher1 = new HasParentMatcher('parentType1', new MatchAllMatcher());
        self::assertInstanceOf(HasParentMatcher::class, $matcher1);
    }
}
