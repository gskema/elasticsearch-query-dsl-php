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
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new GeoHashGridAggregation('field1'))
                ->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = new GeoHashGridAggregation('field1');
        $this->assertInstanceOf(GeoHashGridAggregation::class, $agg);
    }
}
