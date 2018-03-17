<?php

namespace Gskema\ElasticSearchQueryDSL\Matcher\Geo;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\GeoShape\IndexedGeoShape;
use Gskema\ElasticSearchQueryDSL\Model\GeoShape\RawGeoShape;

class GeoShapeMatcherTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "geo_shape": {
                    "field1": {
                        "indexed_shape": {
                            "index": "index1",
                            "type": "type1",
                            "id": "id1",
                            "path": "path1"
                        }
                    }
                }
             }',
            new GeoShapeMatcher(
                'field1',
                new IndexedGeoShape('index1', 'type1', 'id1', 'path1')
            ),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "geo_shape": {
                    "field1": {
                        "shape": {
                            "type" : "polygon",
                            "coordinates" : [
                                [[1, 1], [2, 2], [3, 3]]
                            ]
                        },
                        "relation": "INTERSECTS"
                    },
                    "ignore_unmapped": true
                }
             }',
            new GeoShapeMatcher(
                'field1',
                new RawGeoShape([
                    'type' => 'polygon',
                    'coordinates' => [
                        [[1, 1], [2, 2], [3, 3]]
                    ],
                ]),
                'INTERSECTS',
                ['ignore_unmapped' => true]
            ),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $matcher1 = new GeoShapeMatcher(
            'field1',
            new RawGeoShape([
                'type' => 'polygon',
                'coordinates' => [
                    [[1, 1], [2, 2], [3, 3]]
                ],
            ]),
            'INTERSECTS',
            ['ignore_unmapped' => true]
        );
        $this->assertInstanceOf(GeoShapeMatcher::class, $matcher1);
    }
}
