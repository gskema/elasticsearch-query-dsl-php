<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class DateHistogramAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "date_histogram": {
                    "field": "field1",
                    "interval": "1day"
                }
            }',
            DateHistogramAggregation::fromField(
                'field1',
                '1day'
            ),
        ];

        return $dataSets;
    }
}
