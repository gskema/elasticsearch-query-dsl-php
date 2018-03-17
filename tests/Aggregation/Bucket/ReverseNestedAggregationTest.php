<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class ReverseNestedAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "reverse_nested": {
                    "path": "path1"
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new ReverseNestedAggregation('path1'))
            ->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = new ReverseNestedAggregation('path1');
        $this->assertInstanceOf(ReverseNestedAggregation::class, $agg);
    }
}
