<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class SamplerAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "sampler": {},
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new SamplerAggregation())->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = new SamplerAggregation();
        $this->assertInstanceOf(SamplerAggregation::class, $agg);
    }
}
