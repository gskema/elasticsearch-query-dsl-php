<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Geo;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\GeoPoint;

class GeoBoundingBoxMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
}
