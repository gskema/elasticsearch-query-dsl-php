<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class AvgBucketAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "avg_bucket": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new AvgBucketAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }
}
