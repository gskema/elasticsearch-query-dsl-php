<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class ChildrenAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "children": {
                    "type": "childrenType1"
                }
            }',
            new ChildrenAggregation('childrenType1'),
        ];

        return $dataSets;
    }
}
