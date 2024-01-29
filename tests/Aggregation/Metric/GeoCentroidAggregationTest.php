<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class GeoCentroidAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "geo_centroid": {
                    "field": "field1"
                }
            }',
            new GeoCentroidAggregation('field1'),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg = new GeoCentroidAggregation('field1');

        self::assertInstanceOf(GeoCentroidAggregation::class, $agg);
    }
}
