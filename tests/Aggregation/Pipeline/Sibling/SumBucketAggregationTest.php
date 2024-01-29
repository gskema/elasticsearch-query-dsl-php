<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class SumBucketAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "sum_bucket": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new SumBucketAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }
}
