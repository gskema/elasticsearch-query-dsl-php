<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class SerialDifferencingBucketAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "serial_diff": {
                    "buckets_path": "bucketsPath1",
                    "gap_policy": "insert_zeros"
                }
            }',
            new SerialDifferencingBucketAggregation('bucketsPath1', [
                'gap_policy' => 'insert_zeros',
            ]),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = new SerialDifferencingBucketAggregation('bucketsPath1', [
            'gap_policy' => 'insert_zeros',
        ]);

        $this->assertInstanceOf(SerialDifferencingBucketAggregation::class, $agg);
    }
}
