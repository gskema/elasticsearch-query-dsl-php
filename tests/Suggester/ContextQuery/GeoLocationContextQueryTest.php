<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester\ContextQuery;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\GeoPoint;

class GeoLocationContextQueryTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '[
                { "lat": 1.1, "lon": 1.1 }
            ]',
            (new GeoLocationContextQuery())->addGeoPoint(new GeoPoint(1.1, 1.1)),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '[
                { "lat": 1.1, "lon": 1.1 },
                { "lat": 1.2, "lon": 1.2 }
            ]',
            (new GeoLocationContextQuery())
                ->addGeoPoint(new GeoPoint(1.1, 1.1))
                ->addGeoPoint(new GeoPoint(1.2, 1.2)),
        ];

        return $dataSets;
    }
}
