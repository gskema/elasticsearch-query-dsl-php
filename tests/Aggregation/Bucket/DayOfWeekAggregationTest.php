<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class DayOfWeekAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "terms": {
                    "script": {
                        "source": "doc[\'field1\'].value.dayOfWeekEnum.value",
                        "lang": "painless"
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

    public function testMethods(): void
    {
        $agg = new DayOfWeekAggregation('field1');
        self::assertInstanceOf(DayOfWeekAggregation::class, $agg);
    }
}
