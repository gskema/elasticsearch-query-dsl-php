<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class IpRangeAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $agg = new IpRangeAggregation('field1', [
            ['from' => '10.0.0.5', 'to' => '10.0.0.5', 'key' => 'custom_bucket_key'],
            ['mask' => '10.0.0.0/25', 'key' => 'custom_bucket_key'],
        ]);
        self::assertInstanceOf(IpRangeAggregation::class, $agg);
    }
}
