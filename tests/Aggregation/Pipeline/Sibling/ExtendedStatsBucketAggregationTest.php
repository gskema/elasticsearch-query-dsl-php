<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

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
