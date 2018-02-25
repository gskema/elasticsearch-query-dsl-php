<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class SumAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "sum": {
                    "field": "field1"
                }
            }',
            SumAggregation::fromField('field1'),
        ];

        return $dataSets;
    }
}
