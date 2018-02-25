<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class DerivativeAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "derivative": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new DerivativeAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }
}
