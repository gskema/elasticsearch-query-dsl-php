<?php

namespace Gskema\ElasticSearchQueryDSL\Aggregation\Pipeline\Sibling;

use Gskema\ElasticSearchQueryDSL\AbstractJsonSerializeTestCase;
use Gskema\ElasticSearchQueryDSL\Model\Script\InlineScript;

final class MovingFunctionAggregationTest extends AbstractJsonSerializeTestCase
{
    public static function dataTestJsonSerialize(): iterable
    {
        $dataSets = [];

        // #0
        $dataSets[] = [
            // language=JSON
            '{
                "moving_fn": {
                    "buckets_path": "path1",
                    "window": 10,
                    "script": "script1"
                }
            }',
            new MovingFunctionAggregation('path1', 10, new InlineScript('script1'))
        ];

        return $dataSets;
    }
}
