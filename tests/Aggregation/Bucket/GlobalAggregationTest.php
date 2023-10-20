<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class GlobalAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "global": { },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new GlobalAggregation())
                ->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg = new GlobalAggregation();
        self::assertInstanceOf(GlobalAggregation::class, $agg);
    }
}
