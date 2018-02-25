<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class CardinalityAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "cardinality": {
                    "field": "field1"
                }
            }',
            CardinalityAggregation::fromField('field1'),
        ];

        return $dataSets;
    }
}
