<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class AvgBucketAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $agg = (new AvgBucketAggregation('path1'))
            ->setOption('key1', 'value1');

        self::assertInstanceOf(AvgBucketAggregation::class, $agg);
    }
}
