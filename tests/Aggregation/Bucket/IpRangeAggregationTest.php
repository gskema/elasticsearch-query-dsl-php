<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class IpRangeAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "ip_ranges": {
                    "field": "field1",
                    "ranges": [
                        { "from": "10.0.0.5", "to": "10.0.0.5", "key": "custom_bucket_key" },
                        { "mask": "10.0.0.0/25", "key": "custom_bucket_key" }
                    ]
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new IpRangeAggregation('field1', [
                ['from' => '10.0.0.5', 'to' => '10.0.0.5', 'key' => 'custom_bucket_key'],
                ['mask' => '10.0.0.0/25', 'key' => 'custom_bucket_key'],
            ]))->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = new IpRangeAggregation('field1', [
            ['from' => '10.0.0.5', 'to' => '10.0.0.5', 'key' => 'custom_bucket_key'],
            ['mask' => '10.0.0.0/25', 'key' => 'custom_bucket_key'],
        ]);
        $this->assertInstanceOf(IpRangeAggregation::class, $agg);
    }
}
