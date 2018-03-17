<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class AvgBucketAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "avg_bucket": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new AvgBucketAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = (new AvgBucketAggregation('path1'))
            ->setOption('key1', 'value1');

        $this->assertInstanceOf(AvgBucketAggregation::class, $agg);
    }
}
