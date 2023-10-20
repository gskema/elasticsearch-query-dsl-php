<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class SerialDifferencingBucketAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $agg = new SerialDifferencingBucketAggregation('bucketsPath1', [
            'gap_policy' => 'insert_zeros',
        ]);

        self::assertInstanceOf(SerialDifferencingBucketAggregation::class, $agg);
    }
}
