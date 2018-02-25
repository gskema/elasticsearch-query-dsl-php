<?php

namespace Gskema\ElasticSearchQueryDSL\Model\GeoShape;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class IndexedGeoShapeTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
}
