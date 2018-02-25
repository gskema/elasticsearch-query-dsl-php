<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class MinBucketAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
