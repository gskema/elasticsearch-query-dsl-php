<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

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
