<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class MaxBucketAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
