<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

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
