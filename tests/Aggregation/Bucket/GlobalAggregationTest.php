<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class GlobalAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "global": { },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new GlobalAggregation())
                ->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = new GlobalAggregation();
        $this->assertInstanceOf(GlobalAggregation::class, $agg);
    }
}
