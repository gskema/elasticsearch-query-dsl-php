<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class MaxBucketAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "max_bucket": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new MaxBucketAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }
}
