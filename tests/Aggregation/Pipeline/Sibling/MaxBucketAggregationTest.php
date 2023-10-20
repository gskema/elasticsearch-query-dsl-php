<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

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
