<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

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
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            RangeAggregation::fromField('field1', [
                ['from' => 5, 'to' => 5, 'key' => 'custom_bucket_key'],
            ])->setAgg('key1', new GlobalAggregation()),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "range": {
                    "field": "field1",
                    "ranges": [
                        { "from": 5, "to": 5, "key": "custom_bucket_key" }
                    ],
                    "script": "source1",
                    "missing": 0
                }
            }',
            RangeAggregation::fromField(
                'field1',
                [
                    ['from' => 5, 'to' => 5, 'key' => 'custom_bucket_key'],
                ],
                ['missing' => 0],
                new InlineScript('source1')
            ),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = RangeAggregation::fromField(
            'field1',
            [
                ['from' => 5, 'to' => 5, 'key' => 'custom_bucket_key'],
            ],
            [],
            new InlineScript('source1')
        );
        $this->assertInstanceOf(RangeAggregation::class, $agg);

        $agg = RangeAggregation::fromScript(new InlineScript('source1'), [
            ['from' => 5, 'to' => 5, 'key' => 'custom_bucket_key'],
        ]);
        $this->assertInstanceOf(RangeAggregation::class, $agg);
    }
}
