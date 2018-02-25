<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class GeoBoundsAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
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
}
