<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class GeoCentroidAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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

    public function testMethods()
    {
        $agg = new GeoCentroidAggregation('field1');

        $this->assertInstanceOf(GeoCentroidAggregation::class, $agg);
    }
}
