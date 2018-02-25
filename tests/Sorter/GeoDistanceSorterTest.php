<?php

namespace Gskema\ElasticSearchQueryDSL\Sorter;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\GeoPoint;

class GeoDistanceSorterTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "_geo_distance": {
                   "field1" : {
                      "lat": 1,
                      "lon": 2
                    },
                    "mode": "avg"
                }
            }',
            (new GeoDistanceSorter('field1', new GeoPoint(1, 2)))->setMode('avg'),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "_geo_distance": {
                    "field1" : {
                      "lat": 1,
                      "lon": 2
                    },
                    "mode": "avg",
                    "distance_type": "arc"
                }
            }',
            (new GeoDistanceSorter('field1', new GeoPoint(1, 2)))
                ->setMode('avg')
                ->setOption('distance_type', 'arc'),
        ];

        return $dataSets;
    }
}
