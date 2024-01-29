<?php

namespace Gskema\ElasticsearchQueryDSL\Matcher\Geo;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Model\GeoShape\IndexedGeoShape;
use Gskema\ElasticsearchQueryDSL\Model\GeoShape\RawGeoShape;

final class GeoShapeMatcherTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

    public function testMethods(): void
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
        self::assertInstanceOf(GeoShapeMatcher::class, $matcher1);
    }
}
