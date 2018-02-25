<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class RangeAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "range": {
                    "field": "field1",
                    "ranges": [
                        { "from": 5, "to": 5, "key": "custom_bucket_key" }
                    ]
                }
            }',
            RangeAggregation::fromField('field1', [
                ['from' => 5, 'to' => 5, 'key' => 'custom_bucket_key'],
            ]),
        ];

        return $dataSets;
    }
}
