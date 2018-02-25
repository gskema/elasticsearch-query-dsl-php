<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class DateRangeAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{ 
                "date_range": {
                    "field": "field1",
                    "ranges": {
                        "from": "2016/02/01",
                        "to": "now/d",
                        "key": "custom_bucket_key"
                    }
                }
            }',
            new DateRangeAggregation(
                'field1',
                [
                    'from' => '2016/02/01',
                    'to' => 'now/d',
                    'key' => 'custom_bucket_key'
                ]
            ),
        ];

        return $dataSets;
    }
}
