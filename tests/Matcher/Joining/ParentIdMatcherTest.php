<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\SearchRequest\InnerHits\InnerHitsRequest;

final class ParentIdMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "parent_id": {
                    "type": "childType1",
                    "id": "parentId1"
                }
            }',
            new ParentIdMatcher('childType1', 'parentId1'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "parent_id": {
                    "type": "childType1",
                    "id": "parentId1",
                    "inner_hits": {
                        "name": "name1"
                    }
                }
            }',
            (new ParentIdMatcher('childType1', 'parentId1'))
                ->setInnerHits((new InnerHitsRequest())->setName('name1')),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new ParentIdMatcher('childType1', 'parentId1');
        self::assertInstanceOf(ParentIdMatcher::class, $matcher1);
    }
}
