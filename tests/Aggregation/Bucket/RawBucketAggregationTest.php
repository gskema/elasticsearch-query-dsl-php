<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\Aggregation\RawAggregation;
use Gskema\ElasticSearchQueryDSL\RawFragmentTest;

class RawBucketAggregationTest extends RawFragmentTest
{
    public function testJsonSerializeWithAggs()
    {
        $agg = new RawBucketAggregation(['agg_type_1' => new \stdClass()]);
        $agg->setAgg('agg1', new RawAggregation(['agg_type_2' => new \stdClass()]));

        $actualJson = json_encode($agg->jsonSerialize());

        // language=JSON
        $expectedJson = '{
            "agg_type_1": {},
            "aggs": {
                "agg1": {
                    "agg_type_2": {}
                }
            }
        }';

        $this->assertJsonStringEqualsJsonString($expectedJson, $actualJson);

        $this->testClone('', $agg);
    }

    public function testMethods()
    {
        $agg = new RawBucketAggregation(['agg_type_1' => new \stdClass()]);
        $this->assertInstanceOf(RawBucketAggregation::class, $agg);
    }
}
