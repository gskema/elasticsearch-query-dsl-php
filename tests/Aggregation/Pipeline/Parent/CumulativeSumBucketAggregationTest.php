<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class CumulativeSumBucketAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "cumulative_sum": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new CumulativeSumBucketAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }
}
