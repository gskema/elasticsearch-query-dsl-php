<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

final class RangeAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
    {
        $agg = RangeAggregation::fromField(
            'field1',
            [
                ['from' => 5, 'to' => 5, 'key' => 'custom_bucket_key'],
            ],
            [],
            new InlineScript('source1')
        );
        self::assertInstanceOf(RangeAggregation::class, $agg);

        $agg = RangeAggregation::fromScript(new InlineScript('source1'), [
            ['from' => 5, 'to' => 5, 'key' => 'custom_bucket_key'],
        ]);
        self::assertInstanceOf(RangeAggregation::class, $agg);
    }
}
