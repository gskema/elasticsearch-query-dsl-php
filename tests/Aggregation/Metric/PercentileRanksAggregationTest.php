<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class PercentileRanksAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "percentile_ranks": {
                    "field": "field1",
                    "values": [1, 2, 3]
                }
            }',
            PercentileRanksAggregation::fromField(
                'field1',
                [1, 2, 3]
            ),
        ];

        return $dataSets;
    }
}
