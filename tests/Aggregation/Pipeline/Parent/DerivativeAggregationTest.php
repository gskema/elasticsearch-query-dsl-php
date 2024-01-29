<?php

namespace Gskema\ElasticsearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticsearchQueryDSL\AbstractJsonSerializeTestCase;

final class DerivativeAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "derivative": {
                    "buckets_path": "bucketsPath1"
                }
            }',
            new DerivativeAggregation('bucketsPath1'),
        ];

        return $dataSets;
    }
}
