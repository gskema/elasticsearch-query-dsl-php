<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class ExtendedStatsBucketAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
