<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class CumulativeSumBucketAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "cumulative_sum": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new CumulativeSumBucketAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }
}
