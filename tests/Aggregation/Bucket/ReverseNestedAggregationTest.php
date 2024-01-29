<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class ReverseNestedAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "reverse_nested": {
                    "path": "path1"
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new ReverseNestedAggregation('path1'))
            ->setAgg('key1', new GlobalAggregation()),
        ];

        // #1
        $dataSets[] = [
            // language=JSON
            '{
                "reverse_nested": {}
            }',
            (new ReverseNestedAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg1 = new ReverseNestedAggregation('path1');
        self::assertInstanceOf(ReverseNestedAggregation::class, $agg1);

        $agg2 = new ReverseNestedAggregation();
        self::assertInstanceOf(ReverseNestedAggregation::class, $agg2);
    }
}
