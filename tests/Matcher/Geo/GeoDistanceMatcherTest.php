<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Geo;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\GeoPoint;

class GeoDistanceMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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

    public function testMethods()
    {
        $matcher1 = new GeoDistanceMatcher(
            'field1',
            new GeoPoint(1, 1),
            '50km',
            ['validation_method' => 'IGNORE_MALFORMED']
        );
        $this->assertInstanceOf(GeoDistanceMatcher::class, $matcher1);
    }
}
