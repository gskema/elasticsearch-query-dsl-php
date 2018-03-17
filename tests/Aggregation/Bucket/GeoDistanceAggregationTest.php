<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\GeoPoint;

class GeoDistanceAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "geo_distance": {
                    "field": "field1",
                    "origin": { "lat": 1, "lon": 1 },
                    "ranges": {
                        "from": 10
                    }
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
                    'from' => 10,
                ]
            ))->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = new GeoDistanceAggregation(
            'field1',
            new GeoPoint(1, 1),
            [
                'from' => 10,
            ]
        );
        $this->assertInstanceOf(GeoDistanceAggregation::class, $agg);
    }
}
