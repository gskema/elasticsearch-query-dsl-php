<?php

namespace Gskema\ElasticsearchQueryDSL\Sorter;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticsearchQueryDSL\Model\GeoHash;
use Gskema\ElasticsearchQueryDSL\Model\GeoPoint;

final class GeoDistanceSorterTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
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
            (new GeoDistanceSorter('field1', [new GeoPoint(1, 2)]))->setMode('avg'),
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
            (new GeoDistanceSorter('field1', [new GeoPoint(1, 2)]))
                ->setMode('avg')
                ->setOption('distance_type', 'arc'),
        ];

        // #2
        $dataSets[] = [
            // language=JSON
            '{
                "_geo_distance": {
                    "field1" : {
                      "lat": 1,
                      "lon": 2
                    },
                    "mode": "avg",
                    "distance_type": "arc",
                    "order": "desc",
                    "unit": "km"
                }
            }',
            (new GeoDistanceSorter('field1', [new GeoPoint(1, 2)]))
                ->setMode('avg')
                ->setOption('distance_type', 'arc')
                ->setOrder('desc')
                ->setUnit('km'),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $sorter = new GeoDistanceSorter('field1', [new GeoHash('abc123')]);

        self::assertEquals('field1', $sorter->getField());
        self::assertEquals([new GeoHash('abc123')], $sorter->getOrigins());

        $sorter->setOrder('order1');
        $sorter->setMode('mode1');
        $sorter->setUnit('km');
        $sorter->setOption('key1', 'value1');

        self::assertEquals('order1', $sorter->getOrder());
        self::assertEquals('mode1', $sorter->getMode());
        self::assertEquals('km', $sorter->getUnit());
        self::assertEquals('value1', $sorter->getOption('key1'));
    }
}
