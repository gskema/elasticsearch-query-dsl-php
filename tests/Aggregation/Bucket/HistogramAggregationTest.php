<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class HistogramAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "histogram": {
                    "field": "field1",
                    "interval": 5.0
                }
            }',
            HistogramAggregation::fromField('field1', 5.0),
        ];

        return $dataSets;
    }
}
