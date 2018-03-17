<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

class DiversifiedSamplerAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "diversified_sampler" : {
                    "field": "field1"
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            DiversifiedSamplerAggregation::fromField('field1')
                ->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg1 = DiversifiedSamplerAggregation::fromField('field1');
        $this->assertInstanceOf(DiversifiedSamplerAggregation::class, $agg1);

        $agg2 = DiversifiedSamplerAggregation::fromScript(new InlineScript('source1'));
        $this->assertInstanceOf(DiversifiedSamplerAggregation::class, $agg2);
    }
}
