<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Joining;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

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

        return $dataSets;
    }
}
