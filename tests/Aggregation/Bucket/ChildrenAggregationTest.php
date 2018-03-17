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
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new ChildrenAggregation('childrenType1'))
                ->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = new ChildrenAggregation('childrenType1');
        $this->assertInstanceOf(ChildrenAggregation::class, $agg);
    }
}
