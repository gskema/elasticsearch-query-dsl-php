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
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new DayOfWeekAggregation('field1'))
                ->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods()
    {
        $agg = new DayOfWeekAggregation('field1');
        $this->assertInstanceOf(DayOfWeekAggregation::class, $agg);
    }
}
