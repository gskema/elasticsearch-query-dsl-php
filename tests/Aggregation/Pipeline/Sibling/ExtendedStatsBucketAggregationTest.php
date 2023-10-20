<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class ExtendedStatsBucketAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "extended_stats_bucket": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new ExtendedStatsBucketAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }
}
