<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class MovingAvgAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "moving_avg": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new MovingAvgAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }
}
