<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class SumBucketAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "sum_bucket": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new SumBucketAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }
}
