<?php

namespace Gskema\ElasticSearchQueryDSL\Model\GeoShape;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class IndexedGeoShapeTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "index": "index1",
                "type": "type1",
                "id": "id1",
                "path": "path1"
            }',
            new IndexedGeoShape('index1', 'type1', 'id1', 'path1'),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $shape = new IndexedGeoShape('index1', 'type1', 'id1', 'path1');

        self::assertInstanceOf(IndexedGeoShape::class, $shape);
    }
}
