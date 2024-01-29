<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Model\GeoPoint;

final class GeoDistanceAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "geo_distance": {
                    "field": "field1",
                    "origin": { "lat": 1, "lon": 1 },
                    "ranges": [
                      {
                        "from": 10
                      }
                    ]
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new GeoDistanceAggregation(
                'field1',
                new GeoPoint(1, 1),
                [
                    [
                        'from' => 10,
                    ]
                ]
            ))->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg = new GeoDistanceAggregation(
            'field1',
            new GeoPoint(1, 1),
            [
                [
                    'from' => 10,
                ]
            ]
        );
        self::assertInstanceOf(GeoDistanceAggregation::class, $agg);
    }
}
