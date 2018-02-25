<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Geo;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\GeoPoint;

class GeoDistanceRangeMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "geo_distance_range": {
                    "field1": { "lat": 1, "lon": 1 },
                    "gt": "1km",
                    "lte": "10km"
                }
             }',
            new GeoDistanceRangeMatcher(
                'field1',
                new GeoPoint(1, 1),
                ['gt' => '1km', 'lte' => "10km"]
            ),
        ];

        return $dataSets;
    }
}
