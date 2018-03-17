<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\SearchRequest\InnerHitsRequest;

class ParentIdMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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

    public function testMethods()
    {
        $matcher1 = new ParentIdMatcher('childType1', 'parentId1');
        $this->assertInstanceOf(ParentIdMatcher::class, $matcher1);
    }
}
