<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class StatsBucketAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "stats_bucket": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new StatsBucketAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }
}
