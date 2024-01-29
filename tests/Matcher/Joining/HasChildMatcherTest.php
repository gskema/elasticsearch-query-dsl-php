<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Joining;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Matcher\MatchAllMatcher;
use Gskema\ElasticsearchQueryDSL\SearchRequest\InnerHits\InnerHitsRequest;

final class HasChildMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "has_child": {
                    "type": "childType1",
                    "query": { "match_all": {} }
                }
             }',
            new HasChildMatcher('childType1', new MatchAllMatcher()),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "has_child": {
                    "type": "childType1",
                    "query": { "match_all": {} },
                    "inner_hits": {
                        "name": "name1"
                    }
                }
             }',
            (new HasChildMatcher('childType1', new MatchAllMatcher()))
                ->setInnerHits((new InnerHitsRequest())->setName('name1')),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new HasChildMatcher('childType1', new MatchAllMatcher());
        self::assertInstanceOf(HasChildMatcher::class, $matcher1);
    }
}
