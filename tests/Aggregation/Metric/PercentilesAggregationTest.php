<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class PercentilesAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "percentiles": {
                    "field": "field1",
                    "percents": [1, 2, 3]
                }
            }',
            PercentilesAggregation::fromField('field1', ['percents' => [1, 2, 3]]),
        ];

        return $dataSets;
    }
}
