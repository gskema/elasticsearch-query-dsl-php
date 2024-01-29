<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class MinBucketAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "min_bucket": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new MinBucketAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }
}
