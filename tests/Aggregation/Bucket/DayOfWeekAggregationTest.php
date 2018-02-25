<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTest;

class DayOfWeekAggregationTest extends AbstractJsonSerializeTest
{
    public function dataTestJsonSerialize(): array
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "terms": {
                    "script": {
                        "source": "doc[\'field1\'].date.dayOfWeek",
                        "lang": "expression"
                    }
                }
            }',
            new DayOfWeekAggregation('field1'),
        ];

        return $dataSets;
    }
}
