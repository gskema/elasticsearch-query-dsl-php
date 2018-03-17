<?php

namespace Gskema\ElasticSearchQueryDSL\Sorter;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;
use Gskema\ElasticSearchQueryDSL\Model\GeoHash;
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

        return $dataSets;
    }

    public function testMethods()
    {
        $sorter = new GeoDistanceSorter('field1', [new GeoHash('abc123')]);

        $this->assertEquals('field1', $sorter->getField());
        $this->assertEquals([new GeoHash('abc123')], $sorter->getOrigins());

        $sorter->setOrder('order1');
        $sorter->setMode('mode1');
        $sorter->setUnit('km');
        $sorter->setOption('key1', 'value1');

        $this->assertEquals('order1', $sorter->getOrder());
        $this->assertEquals('mode1', $sorter->getMode());
        $this->assertEquals('km', $sorter->getUnit());
        $this->assertEquals('value1', $sorter->getOption('key1'));
    }
}
