<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class MovingAvgAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
