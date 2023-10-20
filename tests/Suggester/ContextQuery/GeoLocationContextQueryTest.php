<?php

namespace Gskema\ElasticSearchQueryDSL\Suggester\ContextQuery;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\GeoPoint;

final class GeoLocationContextQueryTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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

        // #2
        $dataSets[] = [
            // language=JSON
            '[
                {"context": { "lat": 1.1, "lon": 1.1 }},
                {"context": { "lat": 1.2, "lon": 1.2 }},
                {
                  "context": { "lat": 1.3, "lon": 1.3 },
                  "precision": 5,
                  "boost": 1.0,
                  "neighbours": ["1km", "2km"]
                }
            ]',
            (new GeoLocationContextQuery())
                ->addGeoPoint(new GeoPoint(1.1, 1.1))
                ->addGeoPoint(new GeoPoint(1.2, 1.2))
                ->addGeoPoint(new GeoPoint(1.3, 1.3), 5, 1.0, ['1km', '2km'])
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $ctxQuery = (new GeoLocationContextQuery())
            ->addGeoPoint(new GeoPoint(1.1, 1.1), 5, 1.0, ['1km', '2km']);

        self::assertInstanceOf(GeoLocationContextQuery::class, $ctxQuery);
    }
}
