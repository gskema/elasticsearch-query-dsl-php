<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class GeoBoundsAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "geo_bounds": {
                    "field": "field1"
                }
            }',
            new GeoBoundsAggregation('field1'),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg = new GeoBoundsAggregation('field1');

        self::assertInstanceOf(GeoBoundsAggregation::class, $agg);
    }
}
