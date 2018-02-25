<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Metric;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class ExtendedStatsAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "extended_stats": {
                    "field": "field1"
                }
            }',
            ExtendedStatsAggregation::fromField('field1'),
        ];

        return $dataSets;
    }
}
