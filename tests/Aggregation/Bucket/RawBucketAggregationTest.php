<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\Aggregation\RawAggregation;
use Gskema\ElasticsearchQueryDSL\RawFragmentTest;
use stdClass;

final class RawBucketAggregationTest extends RawFragmentTest
{
    public function testJsonSerializeWithAggs(): void
    {
        $agg = new RawBucketAggregation(['agg_type_1' => new stdClass()]);
        $agg->setAgg('agg1', new RawAggregation(['agg_type_2' => new stdClass()]));

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

        self::assertJsonStringEqualsJsonString($expectedJson, $actualJson);

        $this->testClone('', $agg);
    }

    public function testMethods(): void
    {
        $agg = new RawBucketAggregation(['agg_type_1' => new stdClass()]);
        self::assertInstanceOf(RawBucketAggregation::class, $agg);
    }
}
