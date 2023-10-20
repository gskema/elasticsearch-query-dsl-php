<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class StatsBucketAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "stats_bucket": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new StatsBucketAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }
}
