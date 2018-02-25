<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class GeoHashGridAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "geohash_grid": {
                    "field": "field1"
                }
            }',
            new GeoHashGridAggregation('field1'),
        ];

        return $dataSets;
    }
}
