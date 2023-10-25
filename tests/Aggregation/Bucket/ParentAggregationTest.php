<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class ParentAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "parent": {
                    "type": "type1"
                },
                "aggs": {
                  "agg1": {
                    "global": {}
                  }
                }
            }',
            (new ParentAggregation('type1'))->setAgg('agg1', new GlobalAggregation())
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $obj = (new ParentAggregation('type1'))->setAgg('agg1', new GlobalAggregation());

        self::assertInstanceOf(ParentAggregation::class, $obj);
    }
}
