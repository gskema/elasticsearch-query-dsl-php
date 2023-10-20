<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class ChildrenAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "children": {
                    "type": "childrenType1"
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new ChildrenAggregation('childrenType1'))
                ->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg = new ChildrenAggregation('childrenType1');
        self::assertInstanceOf(ChildrenAggregation::class, $agg);
    }
}
