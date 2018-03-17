<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class MissingAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "missing": {
                    "field": "field1"
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new MissingAggregation('field1'))->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = new MissingAggregation('field1');
        $this->assertInstanceOf(MissingAggregation::class, $agg);
    }
}
