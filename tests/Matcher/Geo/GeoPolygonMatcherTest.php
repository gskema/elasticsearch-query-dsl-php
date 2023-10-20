<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Geo;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\GeoPoint;
use InvalidArgumentException;

final class GeoPolygonMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "geo_polygon": {
                    "field1": {
                        "points": [
                            { "lat": 1, "lon": 1 },
                            { "lat": 2, "lon": 2 },
                            { "lat": 3, "lon": 3 }
                        ]
                    }
                }
             }',
            new GeoPolygonMatcher(
                'field1',
                [
                    new GeoPoint(1, 1),
                    new GeoPoint(2, 2),
                    new GeoPoint(3, 3),
                ]
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new GeoPolygonMatcher(
            'field1',
            [
                new GeoPoint(1, 1),
                new GeoPoint(2, 2),
                new GeoPoint(3, 3),
            ]
        );
        self::assertInstanceOf(GeoPolygonMatcher::class, $matcher1);

        $this->expectException(InvalidArgumentException::class);
        new GeoPolygonMatcher(
            'field1',
            [
                new GeoPoint(1, 1),
                new GeoPoint(2, 2),
            ]
        );
    }
}
