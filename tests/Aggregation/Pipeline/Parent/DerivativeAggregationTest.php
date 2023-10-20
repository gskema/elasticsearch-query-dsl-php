<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Parent;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;

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
