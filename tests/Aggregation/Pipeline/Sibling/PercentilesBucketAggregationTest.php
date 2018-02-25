<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class PercentilesBucketAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "percentiles_bucket": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new PercentilesBucketAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }
}
