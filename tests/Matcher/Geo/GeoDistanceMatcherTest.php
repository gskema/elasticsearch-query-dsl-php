<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Geo;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Model\GeoPoint;

final class GeoDistanceMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "geo_distance": {
                    "field1": { "lat": 1, "lon": 1},
                    "distance": "50km",
                    "validation_method": "IGNORE_MALFORMED"
                }
             }',
            new GeoDistanceMatcher(
                'field1',
                new GeoPoint(1, 1),
                '50km',
                ['validation_method' => 'IGNORE_MALFORMED']
            ),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $matcher1 = new GeoDistanceMatcher(
            'field1',
            new GeoPoint(1, 1),
            '50km',
            ['validation_method' => 'IGNORE_MALFORMED']
        );
        self::assertInstanceOf(GeoDistanceMatcher::class, $matcher1);
    }
}
