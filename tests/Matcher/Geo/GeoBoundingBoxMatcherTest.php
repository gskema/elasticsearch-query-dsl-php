<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Geo;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\GeoPoint;

final class GeoBoundingBoxMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "geo_bounding_box": {
                    "field1": {
                        "top_left": { "lat": 1, "lon": 1 },
                        "bottom_right": { "lat": 2, "lon": 2 }
                    },
                    "type": "indexed"
                }
             }',
            GeoBoundingBoxMatcher::fromTopLeft(
                'field1',
                new GeoPoint(1, 1),
                new GeoPoint(2, 2),
                ['type' => 'indexed']
            ),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "geo_bounding_box": {
                    "field1": {
                        "top_right": { "lat": 1, "lon": 1 },
                        "bottom_left": { "lat": 2, "lon": 2 }
                    },
                    "type": "indexed"
                }
             }',
            GeoBoundingBoxMatcher::fromTopRight(
                'field1',
                new GeoPoint(1, 1),
                new GeoPoint(2, 2),
                ['type' => 'indexed']
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = GeoBoundingBoxMatcher::fromTopLeft(
            'field1',
            new GeoPoint(1, 1),
            new GeoPoint(2, 2),
            ['type' => 'indexed']
        );
        self::assertInstanceOf(GeoBoundingBoxMatcher::class, $matcher1);

        $matcher2 = GeoBoundingBoxMatcher::fromTopRight(
            'field1',
            new GeoPoint(1, 1),
            new GeoPoint(2, 2),
            ['type' => 'indexed']
        );
        self::assertInstanceOf(GeoBoundingBoxMatcher::class, $matcher2);
    }
}
