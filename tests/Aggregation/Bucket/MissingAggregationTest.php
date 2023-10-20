<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Bucket;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

final class MissingAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "missing": {
                    "field": "field1"
                },
                "aggs": {
                    "key1": {
                        "global": {}
                    }
                }
            }',
            (new MissingAggregation('field1'))->setAgg('key1', new GlobalAggregation()),
        ];

        return $dataSets;
    }

    public function testMethods(): void
    {
        $agg = new MissingAggregation('field1');
        self::assertInstanceOf(MissingAggregation::class, $agg);
    }
}
